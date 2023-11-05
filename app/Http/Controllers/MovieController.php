<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Movie; /* import model movie */
use Illuminate\Support\Str;

class MovieController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get movie
        $movie = Movie::latest()->paginate(5);
        //render view with posts
        return view('movie.index', compact('movie'));
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        return view('movie.create');
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Validasi Formulir
        $this->validate($request, [
            'image' => 'required',
            'title' => 'required',
            'director' => 'required',
            'duration' => 'required'
        ]);
        
        if ($request->hasFile('image')) {
            $uploadImage = $request->file('image');
            $oriName = $uploadImage->getClientOriginalName();
            $destinasi = public_path('public/images/');
        
            $uploadImage->move($destinasi, $oriName);
        }       
        
        //Fungsi Simpan Data ke dalam Database
        Movie::create([
            'image' => 'public/images/' . $oriName,
            'title' => $request->title,
            'director' => $request->director,
            'duration' => $request->duration
        ]);

        try {
            return redirect()->route('movie.index');
        } catch (Exception $e) {
            return redirect()->route('movie.index');
        }
    }
    /**
     * edit
     *
     * @param int $id
     * @return void
     */
    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('movie.edit', compact('movie'));
    }
    /**
     * update
     *
     * @param mixed $request
     * @param int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::find($id);
        //validate form
        $this->validate($request, [
            'image' => 'required',
            'title' => 'required',
            'director' => 'required',
            'duration' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $uploadImage = $request->file('image');
            $oriName = $uploadImage->getClientOriginalName();
            $destinationPath = public_path('public/images/');
        
            $uploadImage->move($destinationPath, $oriName);
        } else {
            $oriName = $movie->image;
        }

        $movie->update([
            'image' => 'public/images/' . $oriName,
            'title' => $request->title,
            'director' => $request->director,
            'duration' => $request->duration
        ]);
        return redirect()->route('movie.index')->with(['success' => 'Data Berhasil Diubah!'
        ]);
    }
    /**
     * destroy
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        return redirect()->route('movie.index')->with(['success' => 'DataBerhasil Dihapus!'
        ]);
    }
}