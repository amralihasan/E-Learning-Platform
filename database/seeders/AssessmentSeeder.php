<?php

namespace Database\Seeders;

use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\AssessmentAnswer;
use Illuminate\Database\Seeder;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the assessment
        $assessment = Assessment::updateOrCreate(
            ['title' => 'English Level Assessment'],
            [
                'description' => 'A comprehensive assessment to determine your English proficiency level across reading, listening, and grammar skills.',
                'is_active' => true,
            ]
        );

        // Clear existing questions if re-seeding
        $assessment->questions()->delete();

        // READING SECTION
        $reading1 = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'section' => 'reading',
            'question_text' => 'What is the main idea of the passage?',
            'question_type' => 'multiple_choice',
            'reading_passage' => "The Internet has revolutionized the way we communicate, work, and access information. In the past, people had to visit libraries or use encyclopedias to find information. Today, with just a few clicks, we can access millions of articles, videos, and resources from anywhere in the world. This has made learning more accessible and convenient for everyone.",
            'order' => 1,
            'points' => 2,
        ]);

        AssessmentAnswer::create(['question_id' => $reading1->id, 'answer_text' => 'The Internet has made information more accessible', 'is_correct' => true, 'order' => 1]);
        AssessmentAnswer::create(['question_id' => $reading1->id, 'answer_text' => 'Libraries are no longer useful', 'is_correct' => false, 'order' => 2]);
        AssessmentAnswer::create(['question_id' => $reading1->id, 'answer_text' => 'People don\'t read books anymore', 'is_correct' => false, 'order' => 3]);
        AssessmentAnswer::create(['question_id' => $reading1->id, 'answer_text' => 'The Internet is expensive', 'is_correct' => false, 'order' => 4]);

        $reading2 = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'section' => 'reading',
            'question_text' => 'According to the passage, what was necessary in the past to find information?',
            'question_type' => 'multiple_choice',
            'reading_passage' => "The Internet has revolutionized the way we communicate, work, and access information. In the past, people had to visit libraries or use encyclopedias to find information. Today, with just a few clicks, we can access millions of articles, videos, and resources from anywhere in the world. This has made learning more accessible and convenient for everyone.",
            'order' => 2,
            'points' => 2,
        ]);

        AssessmentAnswer::create(['question_id' => $reading2->id, 'answer_text' => 'Visiting libraries or using encyclopedias', 'is_correct' => true, 'order' => 1]);
        AssessmentAnswer::create(['question_id' => $reading2->id, 'answer_text' => 'Using smartphones', 'is_correct' => false, 'order' => 2]);
        AssessmentAnswer::create(['question_id' => $reading2->id, 'answer_text' => 'Searching online', 'is_correct' => false, 'order' => 3]);
        AssessmentAnswer::create(['question_id' => $reading2->id, 'answer_text' => 'Watching videos', 'is_correct' => false, 'order' => 4]);

        // LISTENING SECTION
        $listening1 = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'section' => 'listening',
            'question_text' => 'What time does the meeting start?',
            'question_type' => 'multiple_choice',
            'audio_url' => null, // You can add audio file path here if you have one
            'order' => 1,
            'points' => 2,
        ]);

        AssessmentAnswer::create(['question_id' => $listening1->id, 'answer_text' => '3:00 PM', 'is_correct' => true, 'order' => 1]);
        AssessmentAnswer::create(['question_id' => $listening1->id, 'answer_text' => '2:30 PM', 'is_correct' => false, 'order' => 2]);
        AssessmentAnswer::create(['question_id' => $listening1->id, 'answer_text' => '3:30 PM', 'is_correct' => false, 'order' => 3]);
        AssessmentAnswer::create(['question_id' => $listening1->id, 'answer_text' => '4:00 PM', 'is_correct' => false, 'order' => 4]);

        $listening2 = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'section' => 'listening',
            'question_text' => 'Where is the conference being held?',
            'question_type' => 'multiple_choice',
            'audio_url' => null,
            'order' => 2,
            'points' => 2,
        ]);

        AssessmentAnswer::create(['question_id' => $listening2->id, 'answer_text' => 'In the main conference room', 'is_correct' => true, 'order' => 1]);
        AssessmentAnswer::create(['question_id' => $listening2->id, 'answer_text' => 'In the cafeteria', 'is_correct' => false, 'order' => 2]);
        AssessmentAnswer::create(['question_id' => $listening2->id, 'answer_text' => 'In the parking lot', 'is_correct' => false, 'order' => 3]);
        AssessmentAnswer::create(['question_id' => $listening2->id, 'answer_text' => 'Online only', 'is_correct' => false, 'order' => 4]);

        // GRAMMAR SECTION
        $grammar1 = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'section' => 'grammar',
            'question_text' => 'Choose the correct sentence:',
            'question_type' => 'multiple_choice',
            'order' => 1,
            'points' => 2,
        ]);

        AssessmentAnswer::create(['question_id' => $grammar1->id, 'answer_text' => 'I have been studying English for three years.', 'is_correct' => true, 'order' => 1]);
        AssessmentAnswer::create(['question_id' => $grammar1->id, 'answer_text' => 'I have been study English for three years.', 'is_correct' => false, 'order' => 2]);
        AssessmentAnswer::create(['question_id' => $grammar1->id, 'answer_text' => 'I have been studied English for three years.', 'is_correct' => false, 'order' => 3]);
        AssessmentAnswer::create(['question_id' => $grammar1->id, 'answer_text' => 'I have been studies English for three years.', 'is_correct' => false, 'order' => 4]);

        $grammar2 = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'section' => 'grammar',
            'question_text' => 'Which sentence uses the correct conditional form?',
            'question_type' => 'multiple_choice',
            'order' => 2,
            'points' => 2,
        ]);

        AssessmentAnswer::create(['question_id' => $grammar2->id, 'answer_text' => 'If I had more time, I would travel more.', 'is_correct' => true, 'order' => 1]);
        AssessmentAnswer::create(['question_id' => $grammar2->id, 'answer_text' => 'If I have more time, I would travel more.', 'is_correct' => false, 'order' => 2]);
        AssessmentAnswer::create(['question_id' => $grammar2->id, 'answer_text' => 'If I had more time, I will travel more.', 'is_correct' => false, 'order' => 3]);
        AssessmentAnswer::create(['question_id' => $grammar2->id, 'answer_text' => 'If I have more time, I will travel more.', 'is_correct' => false, 'order' => 4]);

        $grammar3 = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'section' => 'grammar',
            'question_text' => 'Choose the correct form of the verb: She _____ to the store yesterday.',
            'question_type' => 'multiple_choice',
            'order' => 3,
            'points' => 2,
        ]);

        AssessmentAnswer::create(['question_id' => $grammar3->id, 'answer_text' => 'went', 'is_correct' => true, 'order' => 1]);
        AssessmentAnswer::create(['question_id' => $grammar3->id, 'answer_text' => 'goes', 'is_correct' => false, 'order' => 2]);
        AssessmentAnswer::create(['question_id' => $grammar3->id, 'answer_text' => 'go', 'is_correct' => false, 'order' => 3]);
        AssessmentAnswer::create(['question_id' => $grammar3->id, 'answer_text' => 'going', 'is_correct' => false, 'order' => 4]);

        $grammar4 = AssessmentQuestion::create([
            'assessment_id' => $assessment->id,
            'section' => 'grammar',
            'question_text' => 'Which sentence is grammatically correct?',
            'question_type' => 'multiple_choice',
            'order' => 4,
            'points' => 2,
        ]);

        AssessmentAnswer::create(['question_id' => $grammar4->id, 'answer_text' => 'The books on the shelf are mine.', 'is_correct' => true, 'order' => 1]);
        AssessmentAnswer::create(['question_id' => $grammar4->id, 'answer_text' => 'The books on the shelf is mine.', 'is_correct' => false, 'order' => 2]);
        AssessmentAnswer::create(['question_id' => $grammar4->id, 'answer_text' => 'The books on the shelf am mine.', 'is_correct' => false, 'order' => 3]);
        AssessmentAnswer::create(['question_id' => $grammar4->id, 'answer_text' => 'The books on the shelf was mine.', 'is_correct' => false, 'order' => 4]);

        $this->command->info('Assessment seeded successfully with ' . $assessment->questions()->count() . ' questions!');
    }
}
