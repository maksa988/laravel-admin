<?php

namespace Maksa988\LaravelAdmin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'GET': return $this->rulesGet();
            case 'HEAD': return [];
            case 'DELETE': return $this->rulesDestroy();

            case 'POST': return $this->rulesCreate();

            case 'PUT':
            case 'PATCH': return $this->rulesUpdate();

            default: return [];
        }
    }

    /**
     * Methods: GET
     *
     * @return array
     */
    public function rulesGet()
    {
        return [
            //
        ];
    }

    /**
     * Methods: POST
     *
     * @return array
     */
    public function rulesCreate()
    {
        return [
            //
        ];
    }

    /**
     * Methods: PUT, PATCH
     *
     * @return array
     */
    public function rulesUpdate()
    {
        return [
            //
        ];
    }

    /**
     * Methods: DELETE
     *
     * @return array
     */
    public function rulesDestroy()
    {
        return [
            //
        ];
    }
}
