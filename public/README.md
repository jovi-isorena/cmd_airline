YOW
Project Description:
A web-based flight reservation system. Modeled after the Philippine Airline official website.
Dev used a customized framework (source: https://www.youtube.com/watch?v=n2yeK6LwSII) that applies MVC architecture. 

Installation:
1. Copy this folder [CMD_Airline] to your xampp/htdocs folder. Make sure that you copy the actual folder containing the files and not the wrapper folder from zip.
2. Export/Create the database using the [cmd_airline.sql] file. This file already includes dummy data that users can use. Use the other sql files if you want to create the structure or data only. 
3. Run Apache Web Server and MySql services with Xampp.
4. Open browser and type "localhost/cmd_airline"

Reminders:
1. Not all functionality are working. List of working features:
    a. Login and Registration
    b. Flight booking (Round-trip and One-way)
    c. Ticket printing
    d. Rebooking
    e. Cancellation of booking
    f. All administrative functions (crud forms and system data maintenance) 
2. Expect bugs.
3. You can use the admin account to access the administrative functions
    username: admin@gmail.com
    password: password
4. Register your own flyer account using the registration page. Don't directly insert a record to the users table. Passwords are hashed.
5. Never give up!