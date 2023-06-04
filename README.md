<h1>
    Traffic Lights (API Server)
</h1>

<p>
    ** This repository represents the project's server API
    and must be installed on the server.
</p>

<h2>
    What is it?
</h2>

<p>
    Map and know in real time if the traffic lights in your
    region are open or closed. This repository represents
    the project's server API.
</p>

<h2>
    About this doc
</h2>

<p>
    Both the documentation and the project are not fully
    finalized. This documentation will be updated as the
    project gains new features.
</p>

<h2>
    Install
</h2>

<h3>
    Locally
</h3>
<ol>
    <li>
        Clone the main repository on your local machine: 
        <code>git clone https://github.com/guibastack/traffic-lights-api-server.git</code>.
    </li>
    <li>
        In a terminal inside the project directory, run the 
        <code>composer install</code> to install the 
        Laravel dependencies.
    </li>
    <li>
        Rename the ".env.example" configuration file to ".env".
    </li>
    <li>
        Create a database and add access information in the database 
        section of the .env configuration file.
    </li>
    <li>
        Run <code>php artisan queue:work --queue=default</code> to
        start the queue to send authentication tokens to users.
    </li>
    <li>
        Run <code>php artisan serve</code> to start the local
        server.
    </li>
</ol>
