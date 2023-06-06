<h1>
    🚦 Traffic Lights (API Server) 🚦
</h1>

<p>
    Map and know in real time if the traffic lights in your
    region are open or closed. This repository represents the 
    project's server API and must be installed on the server.
</p>

<h2>Requirements</h2>

<ul>
    <li>
        Latest version of PHP.
    </li>
    <li>
        Composer.
    </li>
    <li>
        MySQL or MariaDB.
    </li>
    <li>
        Access to a terminal.
    </li>
    <li>
        Git Bash (or equivalent for accessing GIT functionality).
    </li>
</ul>

<h2>
    Install
</h2>

<ol>
    <li>
        In a terminal with git access, run <code>git clone https://github.com/guibastack/traffic-lights-api-server.git</code> to clone the main
        repository for this project.
    </li>
    <li>
        In a terminal inside the project directory, run <code>composer install</code> 
        to install all Laravel dependencies.
    </li>
    <li>
        In the root directory of the project, rename the <b>.env.example</b> configuration file to <b>.env</b>.
    </li>
    <li>
        Create a specific database for this project and add the access 
        data in the equivalent section in the .env configuration file 
        (in the root directory of the project).
    </li>
    <li>
        In a terminal within the project, run <code>php artisan migrate</code>
        to perform the database migrations.
    </li>
    <li>
        In a terminal within the project, run 
        <code>php artisan queue:work --queue=default</code> to
        start queuing to send authentication tokens (via email) 
        to users.
    </li>
    <li>
        In a terminal within the project, run 
        <code>php artisan serve</code> to start the local
        server.
    </li>
</ol>

<h2>
    Requests
</h2>

<h3>
    Generate an authentication token
</h3>

<h4>
    Request
</h4>
<ul>
    <li><b>URI</b>: /api/token/auth</li>
    <li><b>Method</b>: POST</li>
    <li><b>Body Type</b>: JSON</li>
    <li><b>Body data</b>: <code>{"email": "your_email_address"}</code></li>
</ul>
<h4>
    Response (codes)
</h4>
<ul>
    <li>
        <b>200</b>: A new authentication token will be sent to the
        provided email address.
    </li>
    <li>
        <b>500</b>: Internal server error. It cannot be resolved 
        on the client side.
    </li>
</ul>

<h3>
    Generate a bearer token
</h3>
<p>
    Before generating a bearer token, it is necessary 
    to generate an authentication token. The authentication
    token will bind to the generated bearer token. Each
    authentication token can only generate 1 (one)
    bearer token.
</p>

<h4>
    Request
</h4>
<ul>
    <li><b>URI</b>: /api/token/bearer</li>
    <li><b>Method</b>: POST</li>
    <li><b>Body Type</b>: JSON</li>
    <li><b>Body data</b>: <code>{"email": "your_email_address", "auth_token": "abc0123"}</code></li>
</ul>
<h4>
    Response (codes)
</h4>
<ul>
    <li>
        <b>200</b>: A new bearer token has been generated.
    </li>
    <li>
        <b>401</b>: The email address provided is not registered,
        the provided auth token is not linked to the provided
        email address or the authentication token provided is
        expired.
    </li>
    <li>
        <b>409</b>: The provided authentication token has already
        been used.
    </li>
    <li>
        <b>500</b>: Internal server error. It cannot be resolved 
        on the client side.
    </li>
</ul>

<h3>
    Destroy the generated bearer token
</h3>

<h4>
    Request
</h4>
<ul>
    <li><b>URI</b>: /api/token/bearer</li>
    <li><b>Method</b>: DELETE</li>
    <li><b>Header Auth (Bearer)</b>: bearer_token_generated</li>
</ul>
<h4>
    Response (codes)
</h4>
<ul>
    <li>
        <b>200</b>: The provided bearer token has been
        destroyed.
    </li>
    <li>
        <b>400</b>: The request is missing a bearer token
        or the provided bearer token is not linked to
        any user account.
    </li>
    <li>
        <b>409</b>: The provided bearer token is already
        expired (expired by expiry date or manually expired
        by user).
    </li>
    <li>
        <b>500</b>: Internal server error. It cannot be
        resolved on the client side.
    </li>
</ul>

<h2>
    License
</h2>
<p>
    This project is under the MIT license. See
    the license in full by <a href="https://github.com/guibastack/traffic-lights-api-server/blob/main/LICENSE">clicking here</a>.
</p>
