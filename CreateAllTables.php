<?php
 	$usr = "group18";
	$pwd = "able7prime7";
	$host = "localhost";
	$db = $usr;

	$server = mysql_connect($host, $usr, $pwd) or die(mysql_error());
	echo "<p>$host is connected!</p>";
	mysql_select_db($db) or die(mysql_error());
	echo "<p>$db is selected</p>";

//////////////////CUSTOMER/////////

	$q = "CREATE TABLE IF NOT EXISTS USER (
	U_ID INT NOT NULL,
	U_EMAIL_ADDRESS VARCHAR(127),
	U_PASSWORD VARCHAR(32),
	U_FIRST_NAME VARCHAR(64),
	U_SURNAME VARCHAR(64),
	U_PHONE_NO VARCHAR(16),
	U_TYPE VARCHAR(32),
	CONSTRAINT pk_User PRIMARY KEY(U_ID))";
	mysql_query($q) or die(mysql_error());


///////////USER_CARD/////////

	$q = "CREATE TABLE IF NOT EXISTS USER_CARD (
	u_ID INT NOT NULL,
	CARD_NAME VARCHAR(128) NOT NULL,
	CARD_NUMBER VARCHAR(16),
	CARD_HOLDERS_NAME VARCHAR(64),
	ISSUE_NUMBER_START_DATE VARCHAR(5),
	EXPIRATION_DATE DATE,
	SECURITY_NUMBER VARCHAR(3),
	B_ADDRESS_LINE_1 VARCHAR(64),
	B_ADDRESS_LINE_2 VARCHAR(64),
	B_TOWN_CITY VARCHAR(64),
	B_COUNTY VARCHAR(64),
	B_POSTCODE VARCHAR(10),
	B_COUNTRY VARCHAR(64),
	CONSTRAINT pk_UserCard PRIMARY KEY(U_ID, CARD_NAME),
	CONSTRAINT fk_U_ID_CARD FOREIGN KEY (U_ID) REFERENCES USER(U_ID)

	)";
		mysql_query($q) or die(mysql_error());

//////////DELIVERY ADDRESS/////////

	$q = "CREATE TABLE IF NOT EXISTS DELIVERY_ADDRESS (
	U_ID INT NOT NULL,
	D_ADDRESS_NAME VARCHAR(64) NOT NULL,
	D_ADDRESS_LINE_1 VARCHAR(64),
	D_ADDRESS_LINE_2 VARCHAR(64),
	D_TOWN_CITY VARCHAR(64),
	D_COUNTY VARCHAR(64),
	D_POSTCODE VARCHAR(10),
	D_COUNTRY VARCHAR(64),
	
	CONSTRAINT pk_U_DELIVERY_ADDRESS PRIMARY KEY(U_ID,D_ADDRESS_NAME),
	CONSTRAINT fk_U_ID_DELIVERY FOREIGN KEY (U_ID) REFERENCES USER(U_ID)

	)";

	mysql_query($q) or die(mysql_error());

//////////PRODUCT/////////

	$q = "CREATE TABLE IF NOT EXISTS PRODUCT (
	P_ID INT NOT NULL,
	P_NAME VARCHAR(255),
	P_ARTIST VARCHAR(64),
	P_TYPE VARCHAR(5),
	P_GENRE VARCHAR(32),
	P_DESC VARCHAR(1024),
	P_AGE_RATING VARCHAR(16),
	P_RELEASE_DATE DATE,
	P_STOCK INT,
	P_PRICE DECIMAL,
	P_IMG_REF VARCHAR(16),
	
	CONSTRAINT pk_Product PRIMARY KEY(P_ID)

	)";

	mysql_query($q) or die(mysql_error());

///////////PRODUCTREVIEW/////////

	$q = "CREATE TABLE IF NOT EXISTS PRODUCT_REVIEW (
	P_ID INT NOT NULL,
	U_ID INT NOT NULL,
	U_P_REVIEW VARCHAR(1023),
	U_P_RATING INT,
	
	CONSTRAINT pk_Product PRIMARY KEY(P_ID,U_ID),
	CONSTRAINT fk_P_ID_REVIEW FOREIGN KEY (P_ID) REFERENCES PRODUCT(P_ID),
	CONSTRAINT fk_U_ID_REVIEW FOREIGN KEY (U_ID) REFERENCES USER(U_ID)

	)";

	mysql_query($q) or die(mysql_error());

////////////////////////////ORDER////////////////////////////////////////////


	$q = "CREATE TABLE IF NOT EXISTS ORDER_TABLE(
	O_ID INT NOT NULL,
	U_ID INT NOT NULL,
	D_METHOD VARCHAR(64),
	D_APPROX DATE,
	SUBTOTAL DECIMAL,
	TOTAL_BEFORE_VAT DECIMAL,
	SALES_TAX DECIMAL,
	POSTAGE DECIMAL,
	ORDER_TOTAL DECIMAL,
	
	CONSTRAINT pk_O_ID PRIMARY KEY(O_ID),
	CONSTRAINT fk_U_ID_ORDER FOREIGN KEY (U_ID) REFERENCES USER(U_ID)

	)";
		mysql_query($q) or die(mysql_error());

///////////////ORDERED PRODUCT///////////////

	$q = "CREATE TABLE IF NOT EXISTS ORDERED_PRODUCT (
	O_ID INT NOT NULL,
	P_ID INT NOT NULL,
	QUANTITY INT,
	
	CONSTRAINT pk_Product PRIMARY KEY(P_ID,O_ID),
	CONSTRAINT fk_P_ID_ORDERED_PRODUCT FOREIGN KEY (P_ID) REFERENCES PRODUCT(P_ID),
	CONSTRAINT fk_ORDER_ID_ORDERED_PRODUCT FOREIGN KEY (O_ID) REFERENCES ORDER_TABLE(O_ID)

	)";
		mysql_query($q) or die(mysql_error());


/////////////LOOK UP TABLES/////////////
	
	$q = "CREATE TABLE IF NOT EXISTS AGE_RATING_LOOKUP (
	AGE_RATING VARCHAR(32),
	AGE_RATING_DESC VARCHAR(511)
	)";
	mysql_query($q) or die(mysql_error());
	
//	$q= "ALTER TABLE PRODUCT ADD COLUMN AGE_RATING VARCHAR(32) REFERENCES AGE_RATING_LOOK_UP (AGE_RATING)";
//mysql_query($q) or die(mysql_error());

	$q="INSERT INTO AGE_RATING_LOOKUP VALUES('E','here is no legal obligation, nor a particular scheme, for labelling material that is exempt from classification.')";
	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO AGE_RATING_LOOKUP VALUES('U','All ages admitted, there is nothing unsuitable for children. Films under this category should not upset children over 4.')";
	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO AGE_RATING_LOOKUP VALUES('PG','All ages admitted, but certain scenes may be unsuitable for children under 8.')";
	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO AGE_RATING_LOOKUP VALUES('12','Nobody younger than 12 can rent or buy a 12-rated VHS, DVD, Blu-ray Disc, UMD or game. Films in this category may include infrequent drugs, infrequent use of strong language, brief nudity, discreet sexual activity, and moderate violence.')";
	mysql_query($q) or die(mysql_error());
	
	$q="INSERT INTO AGE_RATING_LOOKUP VALUES('15','Nobody younger than 15 can rent or buy a 15-rated VHS, DVD, Blu-ray Disc, UMD or game, or watch a film in the cinema with this rating. Films under this category can contain adult themes, hard drugs, strong words, moderate-strong violence/sex references, and mild non-detailed sex activity.')";
	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO AGE_RATING_LOOKUP VALUES('18','Nobody younger than 18 can rent or buy an 18-rated VHS, DVD, Blu-ray Disc, UMD or game, or watch a film in the cinema with this rating. Films under this category do not have limitation on the bad language that is used. Hard drugs are generally allowed, and strong violence/sex references along with strong sexual activity is also allowed. Scenes of strong real sex may be permitted if justified by the context.')";
	mysql_query($q) or die(mysql_error());
	
///////////Delivery Method/////////////
	
	$q = "CREATE TABLE IF NOT EXISTS DELIVERY_METHOD_LOOKUP (
	D_METHOD VARCHAR(64),
	D_PRICE DECIMAL,
	D_APPROX_DAYS INT,
	D_DESC VARCHAR(511))";
	mysql_query($q) or die(mysql_error());
	
//	$q="ALTER TABLE ORDER_TABLE ADD COLUMN D_METHOD VARCHAR(64) REFERENCES DELIVERY_METHOD_LOOKUP (D_METHOD)";
-
	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO DELIVERY_METHOD_LOOKUP VALUES('First Class', 2.50, 2, 'Fastest shipping method')";
	mysql_query($q) or die(mysql_error());
	$q="INSERT INTO DELIVERY_METHOD_LOOKUP VALUES('Second Class', 1.50, 3, 'Not as fast, but not as expensive')";
	mysql_query($q) or die(mysql_error());
	$q="INSERT INTO DELIVERY_METHOD_LOOKUP VALUES('Free Shipping', 0, 5, 'Cheapest shipping method')";
	mysql_query($q) or die(mysql_error());

///////////User type Method/////////////
	
	$q = "CREATE TABLE IF NOT EXISTS USER_LOOKUP (
	U_TYPE VARCHAR(32),
	U_DESC VARCHAR(32)
	)";
	mysql_query($q) or die(mysql_error());
	
	//$q="ALTER TABLE USER
//	 ADD COLUMN  U_TYPE VARCHAR(16) REFERENCES USER_LOOKUP (U_TYPE)";

//	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO USER_LOOKUP VALUES('Customer','Standard Customer to the website')";
	mysql_query($q) or die(mysql_error());
	$q="INSERT INTO USER_LOOKUP VALUES('Admin','Full control over everything')";
	mysql_query($q) or die(mysql_error());

///////////Media Type/////////////
	
	$q = "CREATE TABLE IF NOT EXISTS PRODUCT_TYPE_LOOKUP (
	P_TYPE VARCHAR(5),
	P_DESC VARCHAR(32)
	)";
	mysql_query($q) or die(mysql_error());
	
//	$q="ALTER TABLE PRODUCT
	// ADD COLUMN P_TYPE VARCHAR(5) REFERENCES PRODUCT_TYPE_LOOKUP (P_TYPE)";

	//mysql_query($q) or die(mysql_error());

	$q="INSERT INTO PRODUCT_TYPE_LOOKUP VALUES('CD','A CD.')";
	mysql_query($q) or die(mysql_error());
	$q="INSERT INTO PRODUCT_TYPE_LOOKUP VALUES('DVD','A DVD.')";
	mysql_query($q) or die(mysql_error());
	$q="INSERT INTO PRODUCT_TYPE_LOOKUP VALUES('DVD','A Vinyl. You probably havent heard of it.')";
	mysql_query($q) or die(mysql_error());

///////////GENRE/////////////
	
	$q = "CREATE TABLE IF NOT EXISTS GENRE_LOOKUP (
	GENRE_TYPE VARCHAR(16),
	GENRE_DESC VARCHAR(32)
	)";
	mysql_query($q) or die(mysql_error());
	
	$q="ALTER TABLE PRODUCT
	 ADD COLUMN P_GENRE VARCHAR(16) REFERENCES GENRE_TYPE_LOOKUP (GENRE_TYPE)";

	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO GENRE_TYPE_LOOKUP VALUES('Comedy','Makes you laugh')";
	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO GENRE_TYPE_LOOKUP VALUES('Metal','Heavy stuff')";
	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO GENRE_TYPE_LOOKUP VALUES('Beard','Awesome')";
	mysql_query($q) or die(mysql_error());

	$q="INSERT INTO GENRE_TYPE_LOOKUP VALUES('Rock','Classic')";
	mysql_query($q) or die(mysql_error());

	
	
	
	

//Close
mysql_close($server);
?>
