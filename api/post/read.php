<?php 
//   Including headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';


  // Instantiating Database class and its connect method
  $database = new Database();
  $db = $database->connect();

  // Instantiating Post class constructor method with the database returned as param
  $post = new Post($db);

  // Blog post query
  $result = $post->read();

  // Get row count
  $num = $result->rowCount();


  // Check if there is any post
  if($num > 0) {
    // Post array
    $posts_arr = array();
    // Data array which is the main container for our posts
    $posts_arr['data'] = array();

    // looping thtrough all posts
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // extreact function helps extract the key of an associative array and turn it into a variable itself
        extract($row);

        $post_item = array(
            // We can access id, title and the rest as a variable with the help of extract
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name
        );

        // Push to the data array
        array_push($posts_arr['data'], $post_item);
    }

    // Turn the array to JSON and echo
    echo json_encode($posts_arr);
    

  } else {
    // No Posts
    echo json_encode(
    array('message' => 'No Posts Found')
    );
  }

  

