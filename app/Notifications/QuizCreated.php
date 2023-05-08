<?php

namespace App\Notifications;

use App\Models\Quiz;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuizCreated extends Notification
{
    use Queueable;

    protected $quiz;

    public function __construct(Quiz $quiz)
    {
        $this->quiz = $quiz;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Quiz Created')
                    ->line('A new quiz has been created: ' . $this->quiz->title)
                    ->line('Start Time: ' . $this->quiz->start_time)
                    ->line('End Time: ' . $this->quiz->end_time)
                    ->action('View Quiz', url('/quizzes/' . $this->quiz->id));
    }

    public function toArray($notifiable)
    {
        return [
            'quiz_id' => $this->quiz->id,
            'quiz_title' => $this->quiz->title,
            'start_time' => $this->quiz->start_time,
            'end_time' => $this->quiz->end_time,
        ];
    }
}

