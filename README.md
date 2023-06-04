<h1>
    Traffic Lights (API Server)
</h1>

<p>
    This repository represents the project's server API
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
        In a terminal with git access, run <code>git clone https://github.com/guibastack/traffic-lights-api-server.git</code> to clone the main
        repository for this project to your local machine.
    </li>
    <li>
        In a terminal inside the project directory, run <code>composer install</code> 
        to install all Laravel dependencies.
    </li>
    <li>
        Rename the <b>.env.example</b> configuration file to <b>.env</b>.
    </li>
    <li>
        Create a specific database for this project and add the access 
        data in the equivalent section in the .env configuration file.
    </li>
    <li>
        In a terminal within the project, run <code>php artisan migrate</code>
        to perform the database migrations.
    </li>
    <li>
        In a terminal within the project, run 
        <code>php artisan queue:work --queue=default</code> to
        start queuing to send authentication tokens to users.
    </li>
    <li>
        In a terminal within the project, run 
        <code>php artisan serve</code> to start the local
        server.
    </li>
</ol>
