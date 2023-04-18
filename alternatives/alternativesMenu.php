<?php
// Retrieve the user input from the 'term' parameter
$term = $_GET['term'];

// Define an associative array of options for each input tag
$options = array(
  'Breakfast2' => array(
    'Water',
    'Cold Infuse',
    'Iced Tea'
  ),
  'Breakfast4' => array(
    'Apple',
    'Papaya',
    'Pear',
    'Nashi',
    'Quince',
    'Guayaba',
  ),
  'Breakfast6' => array(
    'Prickly pear',
    'Honey',
    'Fresh lime',
    'Raspberry',
    'Citrus'
  ),
  'Lunch2' => array(
    'Eggs',
    'Apple sauce', 
    'Mashed banana',
    'Quinoa',
    'Lentils',
  ),
  'Lunch4' => array(
    'Egg yolk',
    'Flax seeds',
    'Oil',
    'Gelatin',
    'Tofu'
  ),
  'Lunch6' => array(
    'Tomato, onion, and pepper',
    'Any combination of three fruits'
  ),
  'Lunch8' => array(
    'Toasts',
    'Sliced potatoes',
    'Lettuce leaves',
    'Oat pancakes'
  ),
  'Supper2' => array(
    'Grilled chicken breast',
    'Plant-based meat',
    'Chickenpeas',
    'Beans and sprouts',
    'Bean pastas'
  ),
  'Supper4' => array(
    'Rice',
    'Brown rice',
    'Quinoa',
    'Cauliflower',
    'Barley'
  ),
  'Supper6' => array(
    'Salad',
    'Recommend keeping this'
  ),
  'Collation2' => array(
    'Almonds',
    'Hazelnuts',
    'Cashews',
    'Unsalted pistachios'
  ),
  'Dinner2' => array(
    'Tuna',
    'Canned sardines',
    'Halibut steaks',
    'Salmon',
    'Trout'
  ),
  'Dinner4' => array(
    'Avocado',
    'Pesto',
    'Nut butter',
    'Banana',
    'Chia seeds'
  )
);

// Retrieve the 'input' parameter to determine which input tag is being queried
$input = $_GET['input'];

// Filter the options array to find matches for the user input
$results = array();
foreach ($options[$input] as $option) {
    $results[] = $option;
}

// Return the filtered results as a JSON-encoded array
echo json_encode($results);
?>