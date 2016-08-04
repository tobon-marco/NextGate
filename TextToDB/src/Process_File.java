//STEP 1. Import required packages
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;
public class Process_File {
 // JDBC driver name and database URL
 static final String JDBC_DRIVER = "com.mysql.jdbc.Driver";  
 static final String DB_URL = "jdbc:mysql://localhost/ng_music";

 //  Database credentials
 static final String USER = "ng_user";
 static final String PASS = "ng";
	/**
	 * @param args
	 * Takes in paths to files to be entered into db
	 * @return 
	 */
 	public static List<String> Text_to_Sql (String path, String table)
 	{
 		String template = null;
 		boolean external_key = false;
 		switch (table)
 		{
 			case "ng_users":
 				template = "INSERT INTO ng_users (username, password) VALUES (";
 				break;
 			case "ng_singers":
 				template = "INSERT INTO ng_singers (name, dob, sex) VALUES (";
 				break;
 			case "ng_albums":
 				template = "INSERT INTO ng_albums (album_name, release_year, record_company, ng_singers_id) VALUES (";
 				external_key = true;
 				break;
 		}

 		List<String> queries = new ArrayList<String>();
        // This will reference one line at a time
        String line = null;

        try {
            // FileReader reads text files in the default encoding.
            FileReader fileReader = new FileReader(path);

            // Always wrap FileReader in BufferedReader.
            BufferedReader bufferedReader = new BufferedReader(fileReader);
            
            //SKIP HEADER
            bufferedReader.readLine();
            while(true) 
            {
            	line = bufferedReader.readLine();
                if (line == null)
                {
                	break;
                }
                //SPLIT LINE INTO ARGS
                String [] val = line.split("\\|");
                int i = 0;
                
                //SKIP FIRST ARGUMET IF TS THE ALBUM TABLE
                if ( external_key)
                	i = 1;
                String t2 = template;
                for (i=i; i < val.length; i++)
                {
                	if (i+1 < val.length)
                		t2 += "\"" + val[i].trim() + "\",";
                	else
                	{
                		if (external_key)
                			t2 += "\"" + val[i].trim() + "\",|"+val[0];
                		else
                		{
                			if (table.equals("ng_users"))
                			{
                    			t2 += "MD5(\"" +(val[i].trim()) + "\"));";
                			}
                			else
                    			t2 += "\"" + val[i].trim() + "\");";

                		}
                	}	
                }
                queries.add(t2);
            }   
            // Always close files.
            bufferedReader.close();         
        }
        catch(FileNotFoundException ex) {
            System.out.println("Unable to open file '" + path + "'");                
        }
        catch(IOException ex) {
            System.out.println("Error reading file '" + path + "'");                  
        }
        return queries;
 	}
	/**
	 * @param args
	 * Takes in paths to files to be entered into db
	 */
	public static void main(String[] args) {
		// TODO Auto-generated method stub
		Connection conn = null;
		Statement stmt = null;
		try{
		    //STEP 2: Register JDBC driver
		    Class.forName("com.mysql.jdbc.Driver");

		    //STEP 3: Open a connection
		    System.out.println("Connecting to a selected database...");
		    conn = DriverManager.getConnection(DB_URL, USER, PASS);
		    System.out.println("Connected database successfully...");	
		    //===============================================================================================================================
			if (args.length == 0 )
			{
				System.out.println("Enter paths to files");
			}
			for (String arg: args)
			{
				String[] l_table = arg.split("\\/");
				//Locate file name hopefully the same as the table name
				String table = l_table[l_table.length-1].substring(0, l_table[l_table.length-1].indexOf("."));
				System.out.println("=="+table+"==");
				
				List <String> result = Text_to_Sql(arg, table );
				
				//STEP 4: Execute a query
			    System.out.println("Creating statement...");
			    stmt = conn.createStatement();
			    String sql = null;
			    
				if (table.equals("ng_albums"))
				{
					sql = "SELECT ng_singers_id FROM  ng_singers where  name=\"";
					for (String r: result)
					{
						String[] values = r.split("\\|");
						String s2 = sql + values[1].trim()+ "\"";
//						System.out.println(s2);
						
						ResultSet rs = stmt.executeQuery(s2);
						int id = -1;
						if (rs.next())
						{
							id= rs.getInt("ng_singers_id");
						}
						rs.close();
						System.out.println(values[0] + "\"" + id + "\")");
						stmt.executeUpdate(values[0] + "\"" + id + "\");");
					}
				}
				else
				{
					for ( String r: result)
					{
						System.out.println(r);
						stmt.executeUpdate(r);
					}
				}
			}
			//===============================================================================================================================
		}
		catch(SQLException se){
		      //Handle errors for JDBC
		      se.printStackTrace();
		}
		catch(Exception e){
		      //Handle errors for Class.forName
		      e.printStackTrace();
		}
		finally{
		      //finally block used to close resources
			try{
				if(stmt!=null)
		            conn.close();
		      }
			catch(SQLException se){
		      }// do nothing
		    try{
		    	if(conn!=null)
		    		conn.close();
		      }
		    catch(SQLException se){
		         se.printStackTrace();
		      }//end finally try
		}//end try
		   System.out.println("Goodbye!");

	}
}
