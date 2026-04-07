<?php
// Start the session
session_start();

// Set CORS headers
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Include your database connection file
// This file is expected to create a mysqli connection variable named $conn
include '../Db_Connection/db_spacece.php';

// Check if the connection variable exists
if (!isset($conn) || $conn->connect_error) {
    // Manually set a 500 response code and output error
    http_response_code(500);
    echo json_encode(['status' => 'failure', 'result' => 'Database connection failed. Check db_spacece.php']);
    die();
}

try {
    // 2. Check if a specific 'category' is requested
    if (isset($_GET['category'])) {
        $requestedCategoryName = $_GET['category'];
        
        // Sanitize the input
        $safeCategoryName = mysqli_real_escape_string($conn, $requestedCategoryName);

        // Prepare and execute a query to find the category
        $sql_cat = "SELECT * FROM categories WHERE name = '$safeCategoryName'";
        $res_cat = mysqli_query($conn, $sql_cat);

        if ($res_cat && mysqli_num_rows($res_cat) > 0) {
            $category = mysqli_fetch_assoc($res_cat);
            $category_id = $category['id'];

            // If category is found, fetch its questions
            $sql_q = "SELECT question_text, options FROM questions WHERE category_id = $category_id";
            $res_q = mysqli_query($conn, $sql_q);

            $questions = [];
            if ($res_q) {
                while ($q = mysqli_fetch_assoc($res_q)) {
                    $q['options'] = json_decode($q['options']); // Decode the JSON string
                    $q['question'] = $q['question_text']; // Rename key
                    unset($q['question_text']);
                    $questions[] = $q;
                }
            }

            // Build the final category object
            $output = [
                'name' => $category['name'],
                'questions' => $questions
            ];

            http_response_code(200); // OK
            echo json_encode(['status' => 'success', 'data' => $output, 'result' => 'found']);
        } else {
            // If no matching category was found
            http_response_code(404); // Not Found
            echo json_encode(['status' => 'failure', 'result' => 'Category not found.']);
        }

    } else {
        // 3. If no specific category was requested, return all data
        $sql_all_cat = "SELECT * FROM categories";
        $res_all_cat = mysqli_query($conn, $sql_all_cat);
        
        $output = ['categories' => []];

        if ($res_all_cat && mysqli_num_rows($res_all_cat) > 0) {
             while ($category = mysqli_fetch_assoc($res_all_cat)) {
                $category_id = $category['id'];
                
                // Fetch questions for this category
                $sql_q = "SELECT question_text, options FROM questions WHERE category_id = $category_id";
                $res_q = mysqli_query($conn, $sql_q);
                
                $questions = [];
                if ($res_q) {
                     while ($q = mysqli_fetch_assoc($res_q)) {
                        $q['options'] = json_decode($q['options']); // Decode the JSON string
                        $q['question'] = $q['question_text']; // Rename key
                        unset($q['question_text']);
                        $questions[] = $q;
                    }
                }
                
                // Add to the output array
                $output['categories'][] = [
                    'name' => $category['name'],
                    'questions' => $questions
                ];
            }
            
            http_response_code(200); // OK
            echo json_encode(['status' => 'success', 'data' => $output, 'result' => 'found']);

        } else {
            // No categories found at all
            http_response_code(404); // Not Found
            echo json_encode(['status' => 'failure', 'result' => 'No categories found in database.']);
        }
    }

} catch (Exception $e) {
    // Handle any general errors
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'failure', 'result' => $e->getMessage()]);
}

// Close the connection (optional, as PHP usually closes it automatically, but good practice)
mysqli_close($conn);

// Exit the script.
exit;
?>