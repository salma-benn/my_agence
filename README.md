# my agence
project symfony6
# **Requirements**
- PHP >= 8 (>= 8.1 used in composer.json)
- Symfony- 6.4.*
- MySQL
  
  # **SETUP**
1 - Execute compose :

~~~
    composer install
~~~

2 - Migration DataBase:
~~~
    php bin/console doctrine:migrations:migrate
~~~

3- create virtual Host or Excute :
~~~
  symfony server:start
~~~

4- To access the admin area of your application, you have two authentication options:

   - Create an admin user manually in your database
   - Use the following default admin credentials
     - **Email:** test@test.test
     - **Password:** test
    
       
I use two user providers in my application:

Entity User Provider: This provider loads users from the database using Doctrine. It allows for dynamic user management where user accounts can be created, modified, and stored in the database.
In-Memory User Provider: This provider is configured with predefined user credentials (email and password) in the security.yaml file. It allows access to the application without creating users in the database.

To combine these two providers, I use a Chain User Provider. This merges the Entity User Provider and the In-Memory User Provider, allowing the application to check both sources when authenticating users.
