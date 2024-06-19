<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // method untuk menampilkan data student
    public function index()
    {
        // menarik data dari database
        $students = Student::all();

        // panggil view dan kirim data students
        return view('admin.contents.student.index', [
            'students' => $students
        ]);
    }

    // method untuk menampilkan form tambah student
    public function create()
    {
        // mendapatkan data courses
        $courses = Course::all();

        // panggil view
        return view('admin.contents.student.create', [
            'courses' => $courses
        ]);
    }

    // method untuk menyimpan data student
    public function store(Request $request)
    {
        // validasi data
        $request->validate([
            'name' => 'required',
            'nim' => 'required|numeric',
            'major' => 'required',
            'class' => 'required',
            'course_id' => 'nullable'
        ]);

        // simpan data ke database
        Student::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'major' => $request->major,
            'class' => $request->class,
            'course_id' => $request->course_id
        ]);

        // kembali ke halaman student
        return redirect('/admin/student')->with('message', 'Data student berhasil ditambahkan');
    }
}
