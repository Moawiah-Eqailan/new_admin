<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    public function toggle($id)
    {
        $user = auth()->user();

        if (!$user) {
            $favorites = Session::get('favorites', []);

            if (in_array($id, $favorites)) {
                $favorites = array_diff($favorites, [$id]);
            } else {
                $favorites[] = $id;
            }

            Session::put('favorites', $favorites);

            return response()->json(['success' => true, 'isFavorite' => in_array($id, $favorites)]);
        }

        $isFavorite = $user->favorites()->where('item_id', $id)->exists();

        if ($isFavorite) {
            $user->favorites()->detach($id);
        } else {
            $user->favorites()->attach($id);
        }

        return response()->json(['success' => true, 'isFavorite' => !$isFavorite]);
    }

    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            $favorites = session()->get('favorites', []);
            $favoriteItems = Item::whereIn('id', $favorites)->get();
            foreach ($favoriteItems as $favorite) {
                $favorite->isFavorite = in_array($favorite->id, $favorites);
            }
        } else {
            $favoriteItems = $user->favorites;
            foreach ($favoriteItems as $favorite) {
                $favorite->isFavorite = true;
            }
        }

        return view('Favorites', compact('favoriteItems'));
    }

    
}
