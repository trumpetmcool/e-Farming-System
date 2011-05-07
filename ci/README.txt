The system uses Code Igniter to take advantage of the MVC software architecture. The application folder houses our application. Multiple applications can use the same code igniter installation and have their own separate configurations. Controllers are located in the controllers directory under application. Models are located in the models folder under application. Views are located under the views directory in the application folder.

The application flow works as follows:

1. The user visits the home page
2. The default controller is loaded to show the template and homepage
3. The user logs in or registers which calls those controllers/functions
4. The view for that function/controller shows and then the user enters their data
5. The data is sent to the model
6. The model returns a response to the controller which calls the view
7. The view is returned to the user showing either errors or success