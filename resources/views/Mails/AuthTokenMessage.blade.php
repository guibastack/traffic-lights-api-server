<p>
    Hello, {{$identifier}}!
</p>

<p>
    A login attempt was made to your {{config('app.name')}}
    account. If it wasn't you, just ignore this email and
    don't give the token below to anyone.
</p>

<p>
    If that was you, use the token below to complete your
    authentication process.
</p>

<p style="font-size:30px; font-weight:bold">
    {{$authToken}}
</p>

<p>
    Hugs!
</p>
<p>
    {{config('app.name')}} team.
</p>
