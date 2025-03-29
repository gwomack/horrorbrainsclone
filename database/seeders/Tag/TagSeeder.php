<?php

namespace Database\Seeders\Tag;

use App\Models\Tag\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // A-List Actors
        $actors = [
            'Tom Cruise',
            'Leonardo DiCaprio',
            'Brad Pitt',
            'Denzel Washington',
            'Morgan Freeman',
            'Robert Downey Jr.',
            'Tom Hanks',
            'Samuel L. Jackson',
            'Christian Bale',
            'Will Smith',
            'Johnny Depp',
            'Matthew McConaughey',
            'Keanu Reeves',
            'Ryan Gosling',
            'Chris Hemsworth',
        ];
        $acting = Tag::create(['name' => 'Acting', 'slug' => Str::slug('Acting')]);
        foreach ($actors as $actor) {
            $actor = Tag::create(['name' => $actor, 'slug' => Str::slug($actor)]);
            $actor->parents()->attach($acting);
        }

        // Leading Actresses
        $actresses = [
            'Meryl Streep',
            'Jennifer Lawrence',
            'Scarlett Johansson',
            'Angelina Jolie',
            'Emma Stone',
            'Cate Blanchett',
            'Viola Davis',
            'Nicole Kidman',
            'Julia Roberts',
            'Sandra Bullock',
            'Charlize Theron',
            'Anne Hathaway',
            'Margot Robbie',
            'Emma Watson',
            'Zendaya',
        ];
        foreach ($actresses as $actress) {
            $actress = Tag::create(['name' => $actress, 'slug' => Str::slug($actress)]);
            $actress->parents()->attach($acting);
        }

        // Acclaimed Directors
        $directors = [
            'Steven Spielberg',
            'Martin Scorsese',
            'Christopher Nolan',
            'Quentin Tarantino',
            'James Cameron',
            'Ridley Scott',
            'Peter Jackson',
            'Francis Ford Coppola',
            'Spike Lee',
            'Denis Villeneuve',
            'David Fincher',
            'Guillermo del Toro',
            'Wes Anderson',
            'Ava DuVernay',
            'Greta Gerwig',
        ];
        $directing = Tag::create(['name' => 'Director', 'slug' => Str::slug('Director')]);
        foreach ($directors as $director) {
            $director = Tag::create(['name' => $director, 'slug' => Str::slug($director)]);
            $director->parents()->attach($directing);
        }

        // Production Companies
        $productionCompanies = [
            // 'Warner Bros. Pictures',
            // 'Universal Pictures',
            // 'The Walt Disney Company',
            // 'Paramount Pictures',
            // 'Sony Pictures Entertainment',
            // '20th Century Studios',
            // 'DreamWorks Pictures',
            'Lionsgate',
            'Metro-Goldwyn-Mayer (MGM)',
            'A24',
            'Netflix',
            'Amazon Studios',
            'Apple TV+',
            'Pixar Animation Studios',
            'Marvel Studios',
        ];
        $production = Tag::create(['name' => 'Production', 'slug' => Str::slug('Production')]);
        foreach ($productionCompanies as $productionCompany) {
            $productionCompany = Tag::create(['name' => $productionCompany, 'slug' => Str::slug($productionCompany)]);
            $productionCompany->parents()->attach($production);
        }

        // Distribution Companies
        $distributors = [
            'Walt Disney Studios Motion Pictures',
            'Universal Pictures',
            'Warner Bros. Pictures',
            'Sony Pictures Releasing',
            'Paramount Pictures',
            'Focus Features',
            'Searchlight Pictures',
            'NEON',
            'IFC Films',
            'Magnolia Pictures',
        ];
        $distribution = Tag::create(['name' => 'Distribution', 'slug' => Str::slug('Distribution')]);
        foreach ($distributors as $distributor) {
            $distributor = Tag::create(['name' => $distributor, 'slug' => Str::slug($distributor)]);
            $distributor->parents()->attach($distribution);
        }

        // Rising Stars
        $risingStars = [
            'Timothée Chalamet',
            'Florence Pugh',
            'Tom Holland',
            'Anya Taylor-Joy',
            'Pedro Pascal',
            'Sydney Sweeney',
            'Austin Butler',
            'Jonathan Majors',
            'Jenna Ortega',
            'Jacob Elordi',
        ];
        foreach ($risingStars as $risingStar) {
            $risingStar = Tag::create(['name' => $risingStar, 'slug' => Str::slug($risingStar)]);
            $risingStar->parents()->attach($acting);
        }

        // Production Teams
        $productionTeams = [
            'Hans Zimmer',
            'Roger Deakins',
            'Emmanuel Lubezki',
            'Alan Silvestri',
            'John Williams',
            'Alexandre Desplat',
            'Janusz Kamiński',
            'Robert Richardson',
            'Sandy Powell',
            'Colleen Atwood',
        ];
        foreach ($productionTeams as $productionTeam) {
            $productionTeam = Tag::create(['name' => $productionTeam, 'slug' => Str::slug($productionTeam)]);
            $productionTeam->parents()->attach($production);
        }

        // Genres
        $genres = [
            'Science Fiction',
            'Film Noir',
            'Dark Comedy',
            'Psychological Thriller',
            'Historical Drama',
            'Romantic Comedy',
            'Action Adventure',
            'Musical Theatre',
            'Crime Drama',
            'Documentary Style',
            'Fantasy Adventure',
            'Horror Comedy',
            'Political Drama',
            'War Film',
            'Coming of Age',
        ];
        $genre = Tag::create(['name' => 'Genre', 'slug' => Str::slug('Genre')]);
        foreach ($genres as $genre) {
            $genre = Tag::create(['name' => $genre, 'slug' => Str::slug($genre)]);
            $genre->parents()->attach($genre);
        }

        // Movie Themes
        $movieThemes = [
            'Redemption Story',
            'Good vs Evil',
            'Man vs Nature',
            'Social Justice',
            'Lost Love',
            'Time Travel',
            'Survival Story',
            'Family Bonds',
            'Revenge Plot',
            'Identity Crisis',
            'Power Struggle',
            'Moral Dilemma',
            'Personal Growth',
            'Cultural Clash',
            'Forbidden Love',
        ];
        $movieTheme = Tag::create(['name' => 'Theme', 'slug' => Str::slug('Theme')]);
        foreach ($movieThemes as $movieTheme) {
            $movieTheme = Tag::create(['name' => $movieTheme, 'slug' => Str::slug($movieTheme)]);
            $movieTheme->parents()->attach($movieTheme);
        }

        // Movie Moods
        $movieMoods = [
            'Dark and Gritty',
            'Light Hearted',
            'Emotionally Intense',
            'Thought Provoking',
            'Feel Good',
            'Heart Warming',
            'Edge of Seat',
            'Mind Bending',
            'Tear Jerker',
            'Laugh Out Loud',
            'Suspenseful',
            'Uplifting',
            'Melancholic',
            'Nostalgic',
            'Inspirational',
            'Ensemble Cast',
            'Strong Female Lead',
            'Child Actors',
            'Voice Actors',
            'Method Acting',
            'Award Winning Cast',
            'Breakout Performance',
            'Celebrity Cameos',
            'Dynamic Duo',
            'Veteran Actors',
        ];
        $movieMood = Tag::create(['name' => 'Mood', 'slug' => Str::slug('Mood')]);
        foreach ($movieMoods as $movieMood) {
            $movieMood = Tag::create(['name' => $movieMood, 'slug' => Str::slug($movieMood)]);
            $movieMood->parents()->attach($movieMood);
        }

        // Production Elements
        $productionElements = [
            'Special Effects',
            'Original Score',
            'Period Costume',
            'Practical Effects',
            'Visual Masterpiece',
            'Sound Design',
            'Art Direction',
            'Cinematography',
            'Set Design',
            'Makeup Effects',
        ];
        foreach ($productionElements as $productionElement) {
            Tag::create(['name' => $productionElement, 'slug' => Str::slug($productionElement)]);
        }

        // Story Elements
        $storyElements = [
            'Plot Twist',
            'Multiple Timelines',
            'Nonlinear Story',
            'Character Driven',
            'True Story',
            'Based on Book',
            'Original Screenplay',
            'Dialogue Heavy',
            'Narrated Story',
            'Complex Plot',
        ];
        $storyElement = Tag::create(['name' => 'Story', 'slug' => Str::slug('Story')]);
        foreach ($storyElements as $storyElement) {
            $storyElement = Tag::create(['name' => $storyElement, 'slug' => Str::slug($storyElement)]);
            $storyElement->parents()->attach($storyElement);
        }

        // Setting and Time Period
        $settingAndTimePeriod = [
            'Post Apocalyptic',
            'Victorian Era',
            'Modern Day',
            'Future World',
            'Ancient Times',
            'Middle Ages',
            'Roaring Twenties',
            'Cold War Era',
            'Wild West',
            'Space Setting',
            'Technical Aspects',
            'Black and White',
            'Foreign Language',
            'Silent Film',
            'Hand Drawn',
            'Stop Motion',
            'Found Footage',
            'Single Location',
            'Long Take',
            'Split Screen',
            'Experimental',
            'Family Friendly',
            'Mature Themes',
            'Critical Acclaim',
            'Cult Classic',
            'Award Winner',
        ];
        $settingAndTimePeriodParent = Tag::create(['name' => 'Setting', 'slug' => Str::slug('Setting')]);
        foreach ($settingAndTimePeriod as $tag) {
            $tag = Tag::create(['name' => $tag, 'slug' => Str::slug($tag)]);
            $tag->parents()->attach($settingAndTimePeriodParent);
        }

        // Tag::factory()->count(5)->create();
    }
}
