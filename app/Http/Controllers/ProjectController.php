<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Traits\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use Permission;
    /**
     * Get all blogs in the db
     * @return Blog[]
     */
    public function index()
    {
        return Project::all();
    }

    /**
     * Get blog by id
     * @param string $id
     * @return Project[$id]
     */
    public function show($id)
    {
        return Project::find($id);
    }

    /**
     * Get blogs by title
     * @param string $title
     */
    public function search(Request $request)
    {
        // $query = Blog::select('*');
        // if(isset($request->title)) {
        //     $query->where('title','like','%'. $request->title .'%');
        // }
        // return $query->get();
        return Project::where('name', 'LIKE', '%'  . $request->name . '%')->get();
    }

    /**
     * Add a blog to db
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $projects = Project::create($data);
        return response()->json($projects, 201);
        // return response()->json(['message' => 'user has not permission'], 403);
    }

    /**
     * Update blog by id
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, $id)
    {
        $projects = Project::findOrFail($id);
        $projects->update($request->all());

        return $projects;
    }

    /**
     * Delete blog by id
     * @param string $id
     * @return JsonResponse
     */
    public function delete(Request $request, $id)
    {
        // $user = auth()->guard('api')->user();
        // if(!$user->can('delete')) {
        //     abort(403, 'Doesn\'t have permission');
        // }
        $projects = Project::findOrFail($id);
        $projects->delete();

        return 204;
    }
}
