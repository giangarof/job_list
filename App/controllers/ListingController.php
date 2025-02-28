<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session; 
use Framework\Authorization;

class ListingController{
	protected $db;
	public function __construct(){
		$config = require basePath('../' . 'config/db.php');
		$this->db = new Database($config);
		
	}

	// display all jobs
	public function index(){
		$listings =  $this->db->query('SELECT * FROM listings ORDER BY created_at DESC')->fetchAll();

		loadView('listings/index', ['listings' => $listings]);
	}

	// show the create form
	public function create(){
		loadView('listings/create');
	}

	//display a job descritption
	public function show($params){
		$id = $params['id'] ?? '';
		$params = [
			'id' => $id
		];

		$listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

		//check if listing exists
		if(!$listing){
			ErrorController::notFound('Listing not found');
			return;
		}

		loadView('listings/show', [
			'listing' => $listing
		]);
	}

	// post a job
	public function store(){
		$allowedFields = [
			'title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits', 'tags'
		];
		$newListingData = array_intersect_key($_POST, array_flip($allowedFields));
		$newListingData['user_id'] = Session::get('user')['id'];
		$newListingData = array_map('sanitize', $newListingData);

		$requiredFields =['title', 'description', 'email', 'city', 'state', 'salary'];
		$errors = [];

		foreach ($requiredFields as $field) {
			if(empty($newListingData[$field]) || !Validation::string($newListingData[$field])){
				$errors[$field] = ucfirst($field) . ' is required';
			}
		}

		if(!empty($errors)){
			loadView('listings/create', [
				'errors' => $errors,
				'listing' => $newListingData
			]);
		}else {
			// submit data

			$fields = [];
			$values = [];

			// fields
			foreach($newListingData as $field => $value){
				$fields[] = $field;
			}
			$fields = implode(',', $fields);

			//values
			foreach($newListingData as $field => $value){
				// $values[] = $field;
				// convert empty strings to null
				if($value === ''){
					$newListingData[$field] = null;
				}
				$values[] = ':' . $field;

			}
			$values = implode(', ', $values);

			$query = "INSERT INTO listings ({$fields}) VALUES ({$values})";

			$this->db->query($query, $newListingData);

			// $fields = implode(',', $fields);
			// inspect_and_die($values);
			Session::setFlashMessage('success_message', 'Listing created successfully');

			redirect('/listings');

		}
	}

	// delete job
	public function destroy($params){
		$id = $params['id'];

		$params = [
			'id' => $id
		];

		$listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

		// check if listing exists
		if(!$listing){
			ErrorController::notFound();
			return;
		}

		//authorization
		if(!Authorization::isOwner($listing->user_id)){
			Session::setFlashMessage('error_message', 'You are not authorized to delete this listing');
			return redirect('/listings/' . $listing->id);
		}

		$this->db->query('DELETE FROM listings WHERE id = :id', $params);

		Session::setFlashMessage('success_message', 'Listing deleted successfully');

		redirect('/listings');

	}

	// display edit form
	public function edit($params){
		$id = $params['id'] ?? '';
		$params = [
			'id' => $id
		];

		$listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

		//check if listing exists
		if(!$listing){
			ErrorController::notFound('Listing not found');
			return;
		}

		//authorization
		if(!Authorization::isOwner($listing->user_id)){
			Session::setFlashMessage('error_message', 'You are not authorized to edit this listing');
			return redirect('/listings/' . $listing->id);
		}

		// inspect_and_die($listing);

		loadView('listings/edit', [
			'listing' => $listing
		]);
	}

	//submit update
	public function update($params){
		$id = $params['id'] ?? '';
		$params = [
			'id' => $id
		];

		$listing = $this->db->query('SELECT * FROM listings WHERE id = :id', $params)->fetch();

		//check if listing exists
		if(!$listing){
			ErrorController::notFound('Listing not found');
			return;
		}

		//authorization
		if(!Authorization::isOwner($listing->user_id)){
			Session::setFlashMessage('error_message', 'You are not authorized to update this listing');
			return redirect('/listings/' . $listing->id);
		}

		$allowedFields = [
			'title', 'description', 'salary', 'tags', 'company', 'address', 'city', 'state', 'phone', 'email', 'requirements', 'benefits', 'tags'
		];

		$updateValues = [];

		$updateValues = array_intersect_key($_POST, array_flip($allowedFields));

		$updateValues = array_map('sanitize', $updateValues);

		$requiredFields = ['title', 'description', 'email', 'salary', 'city', 'state'];

		$errors = [];

		foreach($requiredFields as $field){
			if(empty($updateValues[$field]) || !Validation::string($updateValues[$field])){
				$errors[$field] = ucfirst($field) . ' is required';
			}
		}

		if(!empty($errors)){
			loadView('listings/edit', [
				'listing' => $listing,
				'errors' => $errors
			]);
			exit;
		} else{
			//submit to database
			$updateFields = [];
			foreach(array_keys($updateValues) as $field){
				$updateFields[] = "{$field} = :{$field}";

			}
			$updateFields = implode(', ', $updateFields);

			$updateQuery = "UPDATE listings SET $updateFields WHERE id = :id";
			$updateValues['id'] = $id;
			$this->db->query($updateQuery, $updateValues);

			Session::setFlashMessage('success_message', 'Listing updated successfully');

			redirect('/listings/' . $id);

		}

	}

}