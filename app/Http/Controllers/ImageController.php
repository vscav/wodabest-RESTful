<?php

namespace App\Http\Controllers;

use App\Image as Image;
use App\Category as Category;
use App\Like as Like;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Retrive all projects from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $images = Image::latest()->get();
        
            return response()->json($images);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Get the specified project from storage.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getproject(Request $request)
    {
        try
        {
            $image = Image::find($request->id);
        
            return response()->json($image);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Retrieve the top projects from storage. 
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getRankedProjects(Request $request)
    {
        try
        {
            $limit = 12;
            $categories = Category::all();
    
            if($request->category && $request->category !== "all")
            {
                $images = Image::where('category_id', Category::where('slug', request('category'))->value('id'))->orderBy('score', 'desc')->take($limit)->get();
            }
            else
            {
                $images = Image::orderBy('score', 'desc')->take($limit)->get();
            }
            return response()->json($images);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Update the specified project in storage.
     *
     * @param \Illuminate\Http\Request
     * @param App\Image $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $project)
    {
        try
        {
            $data = $request->validate([
                'title' => 'string',
                'description' => 'string'
            ]);

            $project->update($data);

            return response()->json($project, 200);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Create the specified project in storage.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $data = $request->validate([
                'user_id' => 'required|int',
                'title' => 'required|string',
                'description' => 'required|string'
             ]);

                $exploded = explode(',', $request->image);

                $decoded = base64_decode($exploded[1]);
    
                if(str_contains($exploded[0], 'jpeg') || str_contains($exploded[0], 'jpg'))
                {
                    $extension = 'jpg';
                }
                else if(str_contains($exploded[0], 'png'))
                {
                    $extension = 'png';
                }
                else if(str_contains($exploded[0], 'gif'))
                {
                    $extension = 'gif';
                }
                else if(str_contains($exploded[0], 'svg'))
                {
                    $extension = 'svg';
                }
    
                $filename = str_random() . '.' .$extension;
    
                $path = 'img/upload/' .$filename;
    
                file_put_contents($path, $decoded);
    
                $project = new Image;
    
                $category_id =  Category::where('slug', $request->category)->select('id')->first()['id'];
    
                $project->user_id = $request->user_id;
                $project->category_id = $category_id;
                $project->title = $request->title;
                $project->description = $request->description;
                $project->filename = $filename;
    
                $project->save();
    
                return response()->json($project, 201);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Delete the specified project from storage.
     *
     * @param App\Image $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $project)
    {
        try 
        {
            $file_path = public_path() . '/img/upload/' . $project->filename;
            
            $project->delete();
            unlink($file_path);

            return response()->json('Deleted project item.', 200);
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }
}
