<?php  

// Get the base path
function getBasePath($path=''){
    return __DIR__ . '/' . $path;
}

// Load the view
function loadView($name, $data=[]){
    $path = getBasePath("App/views/{$name}.view.php");

    if(file_exists($path)){
        extract($data);
        require $path;

    } else{
        echo "View {$name} doesn't exist!";
    }
}

// Load the partials
function loadPartials($name, $data=[]){

    $path = getBasePath("App/views/partials/{$name}.php");

    if(file_exists($path)){
        extract($data);
        require $path;

    } else{
        echo "Partial {$name} doesn't exist!";
    }
}


// Inspect a value and load the view
function inspect($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}

// Inspect a value and dont execute what comes next
function inspect_and_die($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}


function sanitizeData($dirtyData){

    if (is_array($dirtyData)) {
        return array_map('sanitizeData', $dirtyData);
    }
    
    return filter_var(trim($dirtyData), FILTER_SANITIZE_SPECIAL_CHARS);

}


function redirect($url){
    header("Location: {$url}");
    exit();
}

// Set the message in session
function alert($type, $msg){
    $_SESSION['alert'] = [
        'type' => $type,
        'message' => $msg
    ];
    return;
}


function forgetSuccess(){
    alert('success', 'If an account exists, a reset link has been sent.');
    redirect($_SERVER['HTTP_REFERER']);
    return;
}

?>