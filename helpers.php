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
function loadPartials($name){

    $path = getBasePath("App/views/partials/{$name}.php");

    if(file_exists($path)){
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

?>