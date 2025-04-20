<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // dd("ggggggg");
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'level' => 'required|in:debutant,intermediaire,avance,expert',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'chapitres' => 'required|array',
            'chapitres.*.title' => 'required|string|max:255',
            'chapitres.*.description' => 'nullable|string',
            'chapitres.*.lessons' => 'required|array',
            'chapitres.*.lessons.*.title' => 'required|string|max:255',
            'chapitres.*.lessons.*.type' => 'required|in:text,video',
            'chapitres.*.lessons.*.text_content' => 'required_if:chapitres.*.lessons.*.type,text|nullable|string',
            'chapitres.*.lessons.*.video' => 'required_if:chapitres.*.lessons.*.type,video|nullable|file|mimes:mp4,mov,avi',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre du cours est requis',
            'description.required' => 'La description du cours est requise',
            'image.required' => 'L\'image du cours est requise',
            'category_id.required' => 'La catégorie est requise',
            'price.required' => 'Le prix est requis',
            'level.required' => 'Le niveau est requis',
            'chapitres.required' => 'Au moins un chapitre est requis',
            'chapitres.*.title.required' => 'Le titre du chapitre est requis',
            'chapitres.*.lessons.required' => 'Au moins une leçon est requise pour chaque chapitre',
            'chapitres.*.lessons.*.title.required' => 'Le titre de la leçon est requis',
            'chapitres.*.lessons.*.type.required' => 'Le type de contenu est requis',
            'chapitres.*.lessons.*.type.in' => 'Le type de contenu doit être soit "text" soit "video"',
            'chapitres.*.lessons.*.text_content.required_if' => 'Le contenu texte est requis pour une leçon de type texte',
            'chapitres.*.lessons.*.video.required_if' => 'La vidéo est requise pour une leçon de type vidéo',
        ];
    }
} 