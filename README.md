    
    
    
    //1- Initialising movieticket booking app using codeigniter4 in frontend and nodejs and mongodb in backend
    //2- Implementing add feature to add movie and its detail and store it inside mongoDB.
    //3- Implemented update and delete feature to update movie details and delete it.
    //4- created view for displaying details of movies and fetch data from mongoDB for it.
    //5- created book button and view of seat selection to book the tickets.
    //6- Implemented logic for handeling and saving seats data in mongoDB and adding controller in nodejs to handel them
    //   created funtions-> getSeatsData,addSeatsData,also creaded different schema and cluster to save individual seat booking data.
    //7-> Fetched the seats data and other movie details inside one view to display the ticket.


    // Things remaining...
    //1- Creating authorisation or login before sending user to payment process
    //2- Creating payment process
    //3- Minor bugs solve
    //4- Clear UI design


    //11-12-2024
    //1- session creationg using redis while login and logout
    //2- 2nd half started implementing showing different views to admin and user


    //12-12-2024
    //1- creating logs for user login, duration-spend, logout timing inside database to display it to user.




    // Minuites of meeting (Amit sir) : 12pm

        mailto  : amit@slashrtc.com
        #Tech stack majorly used
            -Imp : MySql, Codeigniter 4, Lua ,Redis, Nodejs
            -other: Kafka,Elastic,Moment,Jquery,Socket,SelectTo

        #Note: 
            -Use CI4 inbuild MySql queries instead of creating of owns
            -Api's are created to connect with MongoDb currently
            -Currently using config.php, have to move to Config table.
            -Write functions in capital letters along with the class name to use the functions without using the routes.
            -Lua is used to insert/set multiple data at a time instead of pushing one at a time.
            -Understand how redis how,why,where....works.

        #Prequesites:
            -How access levels work : Displaying different views,function..., according to role(admin,user,Team lead...).
            -Use pagination to show data as its used in current app.
            -Read about Mysql and Mysql injections.


