<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate; //Pomembno je da uporabljamo facade, če hočemo static method
use App\Project;
class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update', $this->project());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|required', //Ne vedno, samo ko imamo vključena oba
            'description' => 'sometimes|required', //Ne vedno, samo ko imamo vključena oba
            'notes' => 'nullable' //Lahko jih sploh ni
        ];
    }

    public function project()
    {
        return $this->route('project');        
    }

    public function presist()
    {
        $this->project()->update($this->validated()); // 'project' pomeni {project} v routes web-u.       
    }
}
