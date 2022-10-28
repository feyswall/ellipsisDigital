<?php

namespace Database\Factories;


use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'book_name' => $this->faker->name().'\'s Book',
            'book_url' => 'default_pdf.pdf',
            'thumbnail' => 'default_thumbnail.png'
        ];
    }
}
