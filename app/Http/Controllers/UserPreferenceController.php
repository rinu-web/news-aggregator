<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPreferenceController extends Controller
{
    public function updatePreferences(UpdatePreferenceRequest $request)
    {
        $user = Auth::user();

        $preferences = UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            [
                'categories' => $request->categories,
                'sources' => $request->sources
            ]
        );

        return response()->json(['message' => 'Preferences updated successfully', 'preferences' => $preferences]);
    }
      // Get user preferences
      public function getPreferences()
      {
          $user = Auth::user();
          $preferences = UserPreference::where('user_id', $user->id)->first();
  
          return response()->json(['preferences' => $preferences]);
      }

}
