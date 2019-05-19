/**
 * __Setup class for UptownFANK
 * __It connects to database in dijkstra server
 * @author __Naisila Puka___
 * @version __19/05/2019__
 */

import java.sql.*;
import java.util.Properties;

public class Setup
{
	// Connecting through JDBC Driver for MySQL
	// login credentials
	private static final String dbClass = "com.mysql.jdbc.Driver";
	//change this accordingly
	private static final String dbConnection = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/naisila_puka";
	//change this accordingly
	private static final String username = "naisila.puka";
	//change this accordingly
	private static final String password = "BAlFiBwZ";
	private static final String params = "&useUnicode=true&characterEncoding=UTF-8";

	public static void main(String args[]) throws ClassNotFoundException,SQLException
	{
		Connection conn = null;
		Statement stmt = null;
		try
		{
	    	// Connect to database in Dijkstra
			Class.forName(dbClass);
			conn = DriverManager.getConnection(dbConnection + "?user=" + username + "&password=" + password + params);
			System.out.println("Successfully connected to the database!\n");

	        // SQL Table creation
	        String createBasicUser = "CREATE TABLE BasicUser(userID INTEGER PRIMARY KEY AUTO_INCREMENT, name VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, address VARCHAR(50) NOT NULL);";

	        String createPhone = "CREATE TABLE Phone(userID INTEGER NOT NULL, phoneNumber VARCHAR(20) NOT NULL, PRIMARY KEY (userID, phoneNumber), FOREIGN KEY (userID) REFERENCES BasicUser(userID)) ENGINE=INNODB;";

	        String createSuperUser = "CREATE TABLE SuperUser (userID INTEGER PRIMARY KEY, organization VARCHAR(200) NOT NULL, FOREIGN KEY (userID) REFERENCES BasicUser (userID)) ENGINE=INNODB;";

	        String createTeam = "CREATE TABLE Team (teamID INTEGER PRIMARY KEY, name VARCHAR(50) NOT NULL, affiliation VARCHAR(200) NOT NULL, supervisor INTEGER NOT NULL, teamKey INTEGER, FOREIGN KEY (supervisor) REFERENCES SuperUser(userID)) ENGINE=INNODB;";

	        String createMember = "CREATE TABLE Member (userID INTEGER NOT NULL, teamID INTEGER NOT NULL, PRIMARY KEY (userID, teamID), FOREIGN KEY (userID) REFERENCES BasicUser (userID), FOREIGN KEY (teamID) REFERENCES Team (teamID)) ENGINE=INNODB;";

	        String createBoard = "CREATE TABLE Board (boardID INTEGER PRIMARY KEY, ownerID INTEGER, name VARCHAR(50) NOT NULL, description VARCHAR(1000) NOT NULL, priority INTEGER CHECK (priority >= 0 AND priority <=5), color VARCHAR(50) DEFAULT' YELLOW' NOT NULL, requirements VARCHAR(1000) NOT NULL, estimatedTime DATETIME NOT NULL, FOREIGN KEY (ownerID) REFERENCES SuperUser (userID)) ENGINE=INNODB;";
			
			String createWorksOn = "CREATE TABLE WorksOn (boardID INTEGER PRIMARY KEY NOT NULL, teamID INTEGER NOT NULL, FOREIGN KEY (boardID) REFERENCES Board (boardID), FOREIGN KEY (teamID) REFERENCES Team (teamID)) ENGINE=INNODB;";
	        
			String createList = "CREATE TABLE List (listID INTEGER PRIMARY KEY, boardID INTEGER, name VARCHAR(50) NOT NULL, finishedStatus VARCHAR(5), color VARCHAR(30) DEFAULT' YELLOW' NOT NULL, description VARCHAR(1000), activity VARCHAR(1000), FOREIGN KEY (boardID) REFERENCES Board (boardID), CHECK (finishedStatus IN (' True',' False'))) ENGINE=INNODB;";

			String createCard = "CREATE TABLE Card (cardID INTEGER PRIMARY KEY, listID INTEGER, name VARCHAR(50) NOT NULL, priority INTEGER CHECK (priority <= 6 AND priority >= 0), description VARCHAR(1000) NOT NULL, dueDate DATETIME NOT NULL, archived VARCHAR(5) CHECK (archived IN ('True','False')), finished VARCHAR(5) CHECK (finished IN ('True','False')), FOREIGN KEY (listID) REFERENCES List (listID)) ENGINE=INNODB;";
	        
			String createPerformsTask = "CREATE TABLE PerformsTask (cardID INTEGER, userID INTEGER, PRIMARY KEY (cardID, userID), FOREIGN KEY (userID) REFERENCES BasicUser(userID), FOREIGN KEY (cardID) REFERENCES Card(cardID)) ENGINE=INNODB;";
	        
			String createCheckList = "CREATE TABLE CheckList (checklistID INTEGER PRIMARY KEY, relatedCard INTEGER, name VARCHAR(50) NOT NULL, checkStatus VARCHAR(5), CHECK (checkStatus IN ('True','False')), description VARCHAR(1000) NOT NULL, FOREIGN KEY (relatedCard) REFERENCES Card (cardID)) ENGINE=INNODB;";
	        
			String createItem = "CREATE TABLE Item (itemID INTEGER PRIMARY KEY, relatedCheckList INTEGER NOT NULL, completedStatus VARCHAR(5), content VARCHAR(1000) NOT NULL, completor INTEGER NOT NULL, CHECK (completedStatus IN ('True','False')), FOREIGN KEY (relatedCheckList) REFERENCES CheckList (checklistID), FOREIGN KEY (completor) REFERENCES BasicUser (userID)) ENGINE=INNODB;";
	        
			String createComment = "CREATE TABLE Comment (commentID INTEGER, relatedCard INTEGER NOT NULL, timestamp TIMESTAMP NOT NULL, resolvedStatus VARCHAR(5), commenter INTEGER NOT NULL, text VARCHAR(1000) NOT NULL, PRIMARY KEY (commentID, relatedCard), FOREIGN KEY (relatedCard) REFERENCES Card (cardID), FOREIGN KEY (commenter) REFERENCES BasicUser (userID), CHECK (resolvedStatus IN ('True','False'))) ENGINE=INNODB;";
	        
	        String createReplies = "CREATE TABLE Replies (replyID INTEGER NOT NULL, commentID INTEGER NOT NULL, relatedCard INTEGER NOT NULL, PRIMARY KEY (replyID, relatedCard), FOREIGN KEY (replyID, relatedCard) REFERENCES Comment (commentID, relatedCard), FOREIGN KEY (commentID, relatedCard) REFERENCES Comment (commentID, relatedCard)) ENGINE=INNODB;";

	        String createUpvotes = "CREATE TABLE Upvotes (userID INTEGER NOT NULL, commentID INTEGER NOT NULL, relatedCard INTEGER NOT NULL, PRIMARY KEY (userID, commentID, relatedCard), FOREIGN KEY (userID) REFERENCES BasicUser (userID), FOREIGN KEY (commentID, relatedCard) REFERENCES Comment (commentID, relatedCard)) ENGINE=INNODB;";

	        String createAttachment = "CREATE TABLE Attachment (attachmentID INTEGER PRIMARY KEY, name VARCHAR(50) NOT NULL, size INTEGER NOT NULL, uploadDate DATETIME NOT NULL, description VARCHAR(1000) NOT NULL, attacher INTEGER NOT NULL, relatedCard INTEGER NOT NULL, FOREIGN KEY (attacher) REFERENCES BasicUser (userID), FOREIGN KEY (relatedCard) REFERENCES Card (cardID)) ENGINE=INNODB;";

	        String createLabel = "CREATE TABLE Label (labelID INTEGER PRIMARY KEY, color VARCHAR(50) NOT NULL, text VARCHAR(100) NOT NULL, importance INTEGER CHECK (0 < importance <= 5), adder INTEGER NOT NULL, FOREIGN KEY (adder) REFERENCES BasicUser (userID)) ENGINE=INNODB;";
	        
	        String createLabelling = "CREATE TABLE Labelling (cardID INTEGER NOT NULL, labelID INTEGER NOT NULL, PRIMARY KEY (cardID, labelID),FOREIGN KEY (cardID) REFERENCES Card (cardID), FOREIGN KEY (labelID) REFERENCES Label (labelID));";
	        // Check if tables already exist
			DatabaseMetaData meta = conn.getMetaData();
			stmt = conn.createStatement();

			stmt.executeUpdate("DROP TABLE IF EXISTS Labelling");
            stmt.executeUpdate("DROP TABLE IF EXISTS Label");
            stmt.executeUpdate("DROP TABLE IF EXISTS Attachment");

            stmt.executeUpdate("DROP TABLE IF EXISTS Item");
            stmt.executeUpdate("DROP TABLE IF EXISTS CheckList");
            stmt.executeUpdate("DROP TABLE IF EXISTS PerformsTask");

            stmt.executeUpdate("DROP TABLE IF EXISTS Card");
            stmt.executeUpdate("DROP TABLE IF EXISTS List");
            stmt.executeUpdate("DROP TABLE IF EXISTS WorksOn");

            stmt.executeUpdate("DROP TABLE IF EXISTS Board");
            stmt.executeUpdate("DROP TABLE IF EXISTS Member");
            stmt.executeUpdate("DROP TABLE IF EXISTS Team");
            stmt.executeUpdate("DROP TABLE IF EXISTS SuperUser");
            stmt.executeUpdate("DROP TABLE IF EXISTS Phone");
            stmt.executeUpdate("DROP TABLE IF EXISTS BasicUser");

	        // Execute Create Table statements
	        stmt.execute(createBasicUser);
	        stmt.execute(createPhone);
	        stmt.execute(createSuperUser);

	        stmt.execute(createTeam);
	        stmt.execute(createMember);
	        stmt.execute(createBoard);

	        stmt.execute(createWorksOn);
	        stmt.execute(createList);
	        stmt.execute(createCard);

	        stmt.execute(createPerformsTask);
	        stmt.execute(createCheckList);
	        stmt.execute(createItem);

	        stmt.execute(createComment);
	        stmt.execute(createReplies);
	        stmt.execute(createUpvotes);

	        stmt.execute(createAttachment);
	        stmt.execute(createLabel);
	        stmt.execute(createLabelling);
	        System.out.println("Done!");

		}
		catch (SQLException ex)
		{
	        // Print SQL errors
			System.out.println("SQLException: " + ex.getMessage());
			System.out.println("SQLState: " + ex.getSQLState());
			System.out.println("VendorError: " + ex.getErrorCode());
		}
		conn.close();
		System.out.println("Done!");
		System.exit(0);
	}
}