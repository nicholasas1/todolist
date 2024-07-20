<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'deadline'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

// app/Models/Task.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'name', 'description', 'status', 'due_date'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
