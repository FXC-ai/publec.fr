<?php
require 'HTTPRequest.php';

$request = new HTTPRequest($this);

echo $request->requestURI();