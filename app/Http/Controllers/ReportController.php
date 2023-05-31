<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        $result_per_page = 10;
        $query_01 = "SELECT * FROM student_info";
        $result_01 = DB::select($query_01);
        $resultRows = count($result_01);
        $number_of_page = ceil($resultRows / $result_per_page);

        $page = $request->input('page', 1);
        $first_page_number = ($page - 1) * $result_per_page;

        $query = "SELECT event_attendance.studentid, student_info.firstname, student_info.lastname, SUM(event_attendance.timein_no) as totaltimedin, SUM(event_attendance.timeout_no) as totaltimedout, SUM(event_attendance.event_total_absents) as totalabsents
            FROM event_attendance
            JOIN student_info ON event_attendance.studentid = student_info.id
            GROUP BY event_attendance.studentid, student_info.firstname, student_info.lastname
            ORDER BY lastname ASC
            LIMIT $first_page_number, $result_per_page";

        $search = $request->input('search', '');

        if (!empty($search)) {
            $query = "SELECT event_attendance.studentid, student_info.firstname, student_info.lastname, SUM(event_attendance.timein_no) as totaltimedin, SUM(event_attendance.timeout_no) as totaltimedout, SUM(event_attendance.event_total_absents) as totalabsents
                FROM event_attendance
                JOIN student_info ON event_attendance.studentid = student_info.id
                WHERE id LIKE '%$search%' OR firstname LIKE '%$search%' OR lastname LIKE '%$search%'
                GROUP BY event_attendance.studentid, student_info.firstname, student_info.lastname
                ORDER BY lastname";
        }

        $records = DB::select($query);

        return view('report', compact('records', 'number_of_page'));
    }
}
