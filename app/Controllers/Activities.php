<?php

namespace App\Controllers;

use App\Models\ActivityEntryModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Activities extends BaseController
{
    public function index()
    {
        $model = model(ActivityEntryModel::class);

        $data = [
            'activities' =>  $model->getActivities(),
            'title' => 'Activities archive',
        ];
        return view('templates/header', $data)
        . view('activities/index')
        . view('templates/footer');
    }

    public function show($slug = null)
    {
        $model = model(ActivityEntryModel::class);

        $data['news'] = $model->getActivities($slug);

        if (empty($data['activities'])) {
            throw new PageNotFoundException('Cannot find the activity: ' . $slug);
        }

        $data['title'] = $data['activities']['title'];

        return view('templates/header', $data)
            . view('activities/view')
            . view('templates/footer');
    }

    public function new()
    {
        helper('form');

        return view('templates/header', ['title' => 'Create a news item'])
            . view('activities/create')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['title', 'body']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(ActivityEntryModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            . view('activities/success')
            . view('templates/footer');
    }
}