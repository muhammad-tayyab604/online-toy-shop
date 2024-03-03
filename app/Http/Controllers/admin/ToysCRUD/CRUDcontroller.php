<?php

namespace App\Http\Controllers\admin\ToysCRUD;

use App\Http\Controllers\Controller;
use App\Models\Toys;
use Illuminate\Http\Request;

class CRUDcontroller extends Controller
{
    // Toy Adding Form
    public function toyAddForm()
    {
        return view('admin.AddToys.index');
    }

    // Adding toys
    public function store(Request $request)
    {
        // Getting
        $request->validate([
            'toyName' => 'required',
            'availability' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $toy = new Toys();
        $toy->toyName = $request->toyName;
        $toy->availability = $request->availability;
        $toy->quantity = $request->quantity;
        $toy->price = $request->price;
        $toy->description = $request->description;
        $toyImages = [];

        if ($files = $request->file('toy_image')) {
            foreach ($files as $file) {
                $fileName = rand(100, 1000) . time() . $file->getClientOriginalName();
                $filePath = public_path('Image/toys/');
                $file->move($filePath, $fileName);
                $toyImages[] = 'Image/toys/' . $fileName;
            }

            // Save the images paths as a comma-separated string
            $toy->toy_image = implode(',', $toyImages);
        }

        $toy->save();
        return redirect('/admin/toyManagement')->with('message', 'Toy Added Successfully');
    }




    // Edit Form this is the form where toys information will be updated
    public function toyEditForm($id)
    {
        $toy = Toys::findOrFail($id);
        return view('admin.EditToys.index', compact('toy'));
    }

    // THis si the functionality where toys are being updated
    public function update(Request $request, $id)
    {
        $request->validate([
            'toyName' => 'required',
            'availability' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $toy = Toys::findOrFail($id);
        $toy->toyName = $request->toyName;
        $toy->availability = $request->availability;
        $toy->quantity = $request->quantity;
        $toy->price = $request->price;
        $toy->description = $request->description;

        // Process deletion of images
        $deletedImageIndices = explode(',', $request->input('deleted_images'));
        $imageArray = explode(',', $toy->toy_image);

        foreach ($deletedImageIndices as $index) {
            unset($imageArray[$index]);
        }

        // Process addition of new images
        if ($files = $request->file('toy_image')) {
            foreach ($files as $file) {
                $fileName = rand(100, 1000) . time() . $file->getClientOriginalName();
                $filePath = public_path('Image/toys/');
                $file->move($filePath, $fileName);
                $imageArray[] = 'Image/toys/' . $fileName;
            }
        }

        // Save the updated images as a comma-separated string
        $toy->toy_image = implode(',', $imageArray);

        // Save the updated toy
        $toy->save();

        return redirect('/admin/toyManagement')->with('message', 'Toy Updated Successfully');
    }


    // This is the preview page where we can see the information of toys in detail
    public function toyPreview($id)
    {
        $toy = Toys::findOrFail($id);
        return view('admin.Preview.index', compact('toy'));
    }


    // This function is use to delete the toy/toys

    public function delete($id)
    {
        $toy = Toys::findOrFail($id);
        $toy->delete();
        return redirect('/admin/toyManagement')->with('deleteToy', 'Toy Deleted Successfully');
    }

}
