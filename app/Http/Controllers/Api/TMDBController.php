<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TMDBController extends Controller
{
    /**
     * Get a random page from the TMDB API
     * @param int $totalPage
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRandomPage(Request $request)
    {
        $request->validate([
            'total' => 'required|integer|min:1|max:50000',
        ]);

        $total = (int) $request->input('total');

        $first = DB::table('tmdb_total_pages')->find(1);

        if ($first) {
            DB::table('tmdb_total_pages')->update(['total' => $total, 'updated_at' => now()]);
        } else {
            DB::table('tmdb_total_pages')->insert(['total' => $total, 'created_at' => now(), 'updated_at' => now()]);
        }

        $pages = DB::table('tmdb_pages')->pluck('page')->all();

        $pagesArray = array_diff(range(1, $total), $pages);
        $randomPage = $pagesArray[array_rand($pagesArray)];

        DB::table('tmdb_pages')->insert(['page' => $randomPage, 'created_at' => now(), 'updated_at' => now()]);

        return response()->json(['page' => $randomPage]);

    }
}
