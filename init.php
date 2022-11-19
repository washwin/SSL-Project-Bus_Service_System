<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bus_service_system";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Create DATABASE
    $sql_1="DROP DATABASE IF EXISTS ".$dbname.' ;';
    $conn->query($sql_1);
    $sql0 = "CREATE DATABASE IF NOT EXISTS ".$dbname.";";
    $conn->query($sql0);
    $conn = new mysqli($servername, $username, $password,$dbname);
    
    //Create Buss Pass Table
    $sql00="CREATE TABLE IF NOT EXISTS bus_pass(
        busPassId VARCHAR(25) NOT NULL UNIQUE,
        validTill DATETIME
    );";
    $conn->query($sql00);

    // Create users table
    $sql1 = "CREATE TABLE IF NOT EXISTS users(
        userId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        userName VARCHAR(25) NOT NULL UNIQUE,
        pass_word VARCHAR(255) NOT NULL,
        email VARCHAR(25),
        firstName VARCHAR(25) NOT NULL,
        lastName VARCHAR(25),
        userToken VARCHAR(255)
    );";
    $conn->query($sql1);
    
    
    //Insert values in users
    $sql2="INSERT INTO users(userName, pass_word, firstName, lastName) VALUES('likhilesh', 'Password', 'Likhilesh', 'Balpande');"; 
    $sql3="INSERT INTO users(userName, pass_word, firstName, lastName,userToken) VALUES('Varun', 'abcd', 'Varun', 'Bhatt',UUID()); ";
    $sql4="INSERT INTO users(userName, pass_word, firstName, lastName,email,userToken) VALUES('manoj', '1234', 'Manoj', '','manoj@gmail.com',UUID());"; 
    $sq0l5="INSERT INTO users(userName, pass_word, firstName, lastName,email,userToken) VALUES('ashwin', '123', 'Ashwin', 'Waghmare','ashwin@gmail.com',UUID());"; 
    $conn->query($sql2);  
    $conn->query($sql3);  
    $conn->query($sql4);  
    $conn->query($sq0l5);  

    //Create places table
    $sql5="CREATE TABLE IF NOT EXISTS places(
        placeId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        placeName VARCHAR(50) NOT NULL UNIQUE
    );";
    $conn->query($sql5);

    //Insert values into places
    $sql6="INSERT INTO places(placeName) VALUES('Nagpur'),('Pune'),('Kolhapur'),('Hubli'),('Dharwad'),('Banglore');";
    $conn->query($sql6);

    //Create buses table
    $sql7="CREATE TABLE IF NOT EXISTS buses(
        busId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        numberPlate VARCHAR(50) NOT NULL UNIQUE,
        capacity INT default(10) 
    );";
    $conn->query($sql7);
    //Insert values in buses table
    $sql8="INSERT INTO buses(numberPlate) VALUES('MH31AK1234'),('MH62RS4567'),('KA121234'),('KA10ML6789');";
    $conn->query($sql8);
    
    
    // Create Routes Table
    $sql9="CREATE TABLE IF NOT EXISTS routes(
        routeId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        startingPoint INT,
        endingPoint INT,
        startingTime DATETIME,
        endingTime DATETIME,
        travelTime INT,
        fare INT,
        busId INT,
        routeStatus INT DEFAULT(1),
        numberOfBookings INT DEFAULT(0),
        FOREIGN KEY(busId) REFERENCES buses(busId) ON DELETE SET NULL,
        FOREIGN KEY(startingPoint) REFERENCES places(placeId) ON DELETE SET NULL,
        FOREIGN KEY(endingPoint) REFERENCES places(placeId) ON DELETE SET NULL
    );";
    $conn->query($sql9);

    // Insert Data in Routes table
    $sql10="INSERT INTO routes(startingPoint,endingPoint,startingTime,endingTime,travelTime,fare,busId) 
    VALUES
    (2,6,'2022-11-05 8:00','2022-11-05 21:00',780,1450,2),
    (3,4,'2022-11-05 10:00','2022-11-05 16:00',360,550,3),(3,4,'2022-11-05 12:00','2022-11-05 17:00',300,750,4),
    (1,2,'2022-11-11 21:30','2022-11-12 10:00',750,1150,1),(2,1,'2022-11-11 20:00','2022-11-12 11:30',930,850,2),
    (1,2,'2022-11-12 21:30','2022-11-13 10:00',750,1350,1),(2,1,'2022-11-12 23:00','2022-11-13 02:30',930,950,2),
    (1,2,'2022-11-12 18:00','2022-11-13 6:00',720,1350,1),(2,1,'2022-11-12 18:00','2022-11-13 06:30',750,950,2),
    (1,2,'2022-11-12 22:00','2022-11-13 8:00',720,1350,1),(2,1,'2022-11-12 22:00','2022-11-13 08:30',750,950,2),
    (1,2,'2022-11-12 12:00','2022-11-13 2:00',840,1250,1),(2,1,'2022-11-12 16:00','2022-11-13 04:30',750,950,2),
    (1,2,'2022-11-12 14:00','2022-11-13 02:00',840,1150,1),(2,1,'2022-11-12 26:00','2022-11-13 05:30',750,850,2);
    ";

    $conn->query($sql10);

    // Payments Table
    $sql11="CREATE TABLE IF NOT EXISTS payment_type(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL
    );";
    $conn->query($sql11);

    // Insert data in payments table
    $sql12="INSERT INTO payment_type(name) VALUES('Cash'),('Debit Card'),('Credit Card'),('UPI'),('Bus_Pass');";
    $conn->query($sql12);

    // Bookings Table
    $sql14="CREATE TABLE IF NOT EXISTS bookings(
        bookingId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        routeId INT,
        userId INT,
        numberOfSeats INT DEFAULT(1),
        paymentType INT,
        bookingDate DATETIME DEFAULT(now()),
        paymentDetails VARCHAR(255),
        FOREIGN KEY(routeId) REFERENCES routes(routeId) ON DELETE SET NULL,
        FOREIGN KEY(userId) REFERENCES users(userId) ON DELETE SET NULL,
        FOREIGN KEY(paymentType) REFERENCES payment_type(id) ON DELETE SET NULL
    );";
    $conn->query($sql14);
    // Insert Into Bookings table
    $sql15="INSERT INTO bookings(routeId,userId,paymentType) values(1,2,4);";
    $conn->query($sql15);

    //Customers Table
    $sql19="CREATE TABLE IF NOT EXISTS customers(
        customerId VARCHAR(255) PRIMARY KEY,
        name VARCHAR(255),
        phoneNumber VARCHAR(13),
        bookingId INT,
        seatAlloted INT,
        gender VARCHAR(25),
        age INT,
        FOREIGN KEY(bookingId) REFERENCES bookings(bookingId) ON DELETE SET NULL
    );";
    $conn->query($sql19);
    $sql19_1="INSERT INTO customers(customerId,name,phoneNumber,bookingId,seatAlloted) values('1_1','Cus1','123456',1,9);";
    $conn->query($sql19_1);

    // // available Table
    // $sql13="CREATE TABLE IF NOT EXISTS available(
    //     routeId INT UNIQUE,
    //     seat1 INT,
    //     seat2 INT,
    //     seat3 INT,
    //     seat4 INT,
    //     seat5 INT,
    //     seat6 INT,
    //     seat7 INT,
    //     seat8 INT,
    //     seat9 INT,
    //     seat10 INT,
    //     FOREIGN KEY(routeId) REFERENCES routes(routeId) ON DELETE SET NULL
    // );";
    // $conn->query($sql13);
    // //$conn->query("INSERT INTO available VALUES(1,0,1,1,0,1,1,1,0,1);")
    // $conn->query("INSERT INTO `available` (`routeId`, `seat1`, `seat2`, `seat3`, `seat4`, `seat5`, `seat6`, `seat7`, `seat8`, `seat9`, `seat10`) VALUES ('1', '0', '1', '1', '1', '0', '1', '1', '1', '0', '1');");
    $sql21="CREATE TABLE IF NOT EXISTS available(
            availabilityId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            routeId INT,
            seat1 VARCHAR(255),
            seat2 VARCHAR(255),
            seat3 VARCHAR(255),
            seat4 VARCHAR(255),
            seat5 VARCHAR(255),
            seat6 VARCHAR(255),
            seat7 VARCHAR(255),
            seat8 VARCHAR(255),
            seat9 VARCHAR(255),
            seat10 VARCHAR(255),
        FOREIGN KEY(routeId) REFERENCES routes(routeId) ON DELETE SET NULL
    );";
    $conn->query($sql21);
    $sql21_1="INSERT INTO available(routeId,seat3) values('1','1_1');";
    $conn->query($sql21_1);
    

    // check if the route exists in available table
    $sql16="SELECT routeId from available where routeId = 1;";
    $conn->query($sql16);

    // Make the corrosponding entry in available table
    // $sql17="INSERT INTO available(routeId) VALUES(1);";
    // $conn->query($sql17);

    // $sql18="UPDATE available SET seat1=878 WHERE routeId = 1;";
    // $conn->query($sql18);


    //Create Customer Table
    // $sql19="CREATE TABLE IF NOT EXISTS customer_info(
    //     customerId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    //     routeId INT,
    //     bookingId INT,
    //     name VARCHAR(25) NOT NULL,
    //     phone VARCHAR(25),
    //     seatNumber INT NOT NULL,
    //     FOREIGN KEY(routeId) REFERENCES routes(routeId) ON DELETE SET NULL,
    //     FOREIGN KEY(bookingId) REFERENCES bookings(bookingId) ON DELETE SET NULL
    // );";
    

    // Create Complaints table
    $sql20="CREATE TABLE IF NOT EXISTS complaints(
        complaintId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        description TEXT NOT NULL
    );";
    $conn->query($sql20);

    //$temp = "DROP TABLE admins;";
    //$conn->query($temp);
    $sql21 = "CREATE TABLE IF NOT EXISTS admins(
        adminId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        Username VARCHAR(25) NOT NULL UNIQUE,
        Pass_word VARCHAR(255) NOT NULL
        );";
    $conn->query($sql21);

    //Insert admin details in admins

    $sql23 = "INSERT INTO admins(Username,Pass_word) VALUES('amruthago','123456');";
    $conn->query($sql23);

    // //Add payment details to Bookings table
    // $sql21="ALTER TABLE bookings
    //      ADD paymentDetails VARCHAR(251);";
    // $conn->query($sql21);


    // Check connection
        // if ($conn->connect_error) {
        //   die("Connection failed: " . $conn->connect_error);
        // }


    
    
    


?>