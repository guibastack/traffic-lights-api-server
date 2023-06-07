<h1>
    🚦 Traffic Lights (API Server) 🚦
</h1>

<p>
    Map and know in real time if the traffic lights in your
    region are open or closed. This repository represents the 
    project's server API and must be installed on the server.
</p>

<p>
    ** The <strong>Traffic Lights App</strong> (developed in
    React Native by me) will consume this API, sending and 
    fetching traffic light data. Access the App repository
    by <a href="https://github.com/guibastack/traffic-lights-app-react-native">clicking here</a>. **
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
        In the root directory of the project, rename the <strong>.env.example</strong> configuration file to <strong>.env</strong>.
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
    <li>
        <strong>URI</strong>: /api/token/auth
    </li>
    <li>
        <strong>Method</strong>: POST
    </li>
    <li>
        <strong>Body type</strong>: JSON
    </li>
    <li>
        <strong>Body data</strong>: <code>{"email": "your_email_address"}</code>
    </li>
</ul>
<h4>
    Response (codes)
</h4>
<ul>
    <li>
        <strong>200</strong>: A new authentication token will be sent to the
        provided email address.
    </li>
    <li>
        <strong>422</strong>: There are semantic errors in the
        formation of your JSON request.
    </li>
    <li>
        <strong>500</strong>: Internal server error. It cannot be resolved 
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
    <li>
        <strong>URI</strong>: /api/token/bearer
    </li>
    <li>
        <strong>Method</strong>: POST
    </li>
    <li>
        <strong>Body type</strong>: JSON
    </li>
    <li>
        <strong>Body data</strong>: <code>{"email": "your_email_address", "auth_token": "abc0123"}</code>
    </li>
</ul>
<h4>
    Response (codes)
</h4>
<ul>
    <li>
        <strong>200</strong>: A new bearer token has been generated.
    </li>
    <li>
        <strong>401</strong>: The email address provided is not registered,
        the provided auth token is not linked to the provided
        email address or the authentication token provided is
        expired.
    </li>
    <li>
        <strong>409</strong>: The provided authentication token has already
        been used.
    </li>
    <li>
        <strong>422</strong>: There are semantic errors in the
        formation of your JSON request.
    </li>
    <li>
        <strong>500</strong>: Internal server error. It cannot be resolved 
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
    <li>
        <strong>URI</strong>: /api/token/bearer
    </li>
    <li>
        <strong>Method</strong>: DELETE
    </li>
    <li>
        <strong>Header auth (Bearer token)</strong>: bearer_token_generated
    </li>
</ul>
<h4>
    Response (codes)
</h4>
<ul>
    <li>
        <strong>200</strong>: The provided bearer token has been
        destroyed.
    </li>
    <li>
        <strong>400</strong>: The request is missing a bearer token
        or the provided bearer token is not linked to
        any user account.
    </li>
    <li>
        <strong>409</strong>: The provided bearer token is already
        expired (expired by expiry date or manually expired
        by user).
    </li>
    <li>
        <strong>500</strong>: Internal server error. It cannot be
        resolved on the client side.
    </li>
</ul>

<h3>
    Map new traffic light
</h3>

<h4>
    Request
</h4>
<ul>
    <li>
        <strong>URI</strong>: /api/trafficlights
    </li>
    <li>
        <strong>Method</strong>: POST
    </li>
    <li>
        <strong>Header auth (Bearer Token)</strong>: bearer_token_generated
    </li>
    <li>
        <strong>Body type</strong>: JSON
    </li>
    <li>
        <strong>Body data</strong>: <code>{"latitude": "99,99999999", "longitude": "99,99999999", "name": "Crossing between 1st street and 2nd street", "red_light_start": (string format: "2023-06-07 15:40:00"), "red_light_duration_in_seconds": 45, "yellow_light_duration_in_seconds": 2, "green_light_duration_in_seconds": 180}</code>
    </li>
</ul>

<h4>
    Response (codes)
</h4>
<ul>
    <li>
        <strong>200</strong>: Traffic light successfully mapped.
    </li>
    <li>
        <strong>400</strong>: The request is missing a bearer token
        or the provided bearer token is not linked to
        any user account.
    </li>
    <li>
        <strong>409</strong>: The provided bearer token is already
        expired (expired by expiry date or manually expired
        by user).
    </li>
    <li>
        <strong>422</strong>: There are semantic errors in the
        formation of your JSON request.
    </li>
    <li>
        <strong>500</strong>: Internal server error. It cannot be
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
