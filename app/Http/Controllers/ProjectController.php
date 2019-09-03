<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Project;

class ProjectController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

       return redirect('admin/home');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('admin.add_project');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'file' => 'required'
        ]);
        $file = $request->file('file');

        if($request->hasFile('file')){
            $acceptedExtensions = ['docx', 'doc', 'pdf'];
            $projectFile = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();
            //$targetPath = "radar.com";

          // return $projectFile;

            if(!in_array($extension, $acceptedExtensions)){
                return redirect('admin/create')->with('error', 'unsupported file format..docx, pdf are accepted');
            }

            
             //Move Uploaded File
      $destinationPath = './storage/project_files';
      $file->move($destinationPath,$file->getClientOriginalName());
      
      
      //$request->file('file')->storeAs('public/storage/project_files', $projectFile);
        

            $project = new Project();
                    $project->title = $request->title;
                    $project->description = $request->description;
                    $project->file_path = $projectFile;
                    $project->save();

             return redirect('admin/home')->with('success', 'Project Added Successfully');

        }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);
        return view('admin.project_detail')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        return view('admin.edit_project')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        $project = Project::find($id); 

        if($request->hasFile('file')){
            $file = $request->file('file');
            $acceptedExtensions = ['docx', 'doc', 'pdf'];
            $projectFile = $request->file('file')->getClientOriginalName();
            $extension = $request->file('file')->getClientOriginalExtension();

            if(!in_array($extension, $acceptedExtensions)){
                return redirect('admin/create')->with('error', 'unsupported file format..docx, pdf are accepted');
            }
            $projectFile = $project->file_path;
             $destinationPath = './storage/project_files';
      $file->move($destinationPath,$projectFile);
            //$request->file('file')->storeAs('public/project_files', $projectFile);

           
        }
        else{
            $projectFile = $project->file_path;
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->file_path = $projectFile;
        $project->update();

        return redirect("admin/{$id}/edit")->with('success', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
    
        $project = Project::find($id);
       $destinationPath = "./storage/project_files/{$project->file_path}";
        if(unlink($destinationPath)){
            $project->delete();
            return redirect('admin/home')->with('success', 'Project Removed Successfully');
        }
        else{
           return redirect('admin/home')->with('error', 'Project Removal Failed');
        }
        //Storage::delete("public/project_files/{$project->file_path}");
        
    }

}
