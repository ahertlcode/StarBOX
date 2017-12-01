<?php
/**
 * Copyright 2014 OneAll, LLC.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 */

// HTTP Handler and Configuration
include '../assets/config.php';

// Discussion API \ List all discussions
// http://docs.oneall.com/api/resources/discussions/list-all-discussions/

// The page to retrieve
$page = 1;

// Entries per page
$entries_per_page = 150;

// Newest first
$order_direction = 'desc';

//Comments per discussion
$comments_per_discussion = 2;

// References to read
$discussion_references = array ();
$discussion_references [] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1';
$discussion_references [] = '12345678901234567890';

// Make Request
$oneall_curly->get (SITE_DOMAIN . "/discussions/summary.json?page=" . $page . "&entries_per_page=" . $entries_per_page . "&order_direction=" . $order_direction . "&comments_per_discussion=".$comments_per_discussion."&discussion_reference=" . implode (";", $discussion_references));
$result = $oneall_curly->get_result ();

// Success
if ($result->http_code == 200)
{
	echo "<h1>Success " . $result->http_code . "</h1>";
	echo "<pre>" . oneall_pretty_json::format_string ($result->body) . "</pre>";
}
// Error
else
{
	echo "<h1>Error " . $result->http_code . "</h1>";
	echo "<pre>" . oneall_pretty_json::format_string ($result->body) . "</pre>";
}
?>