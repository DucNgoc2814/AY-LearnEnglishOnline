import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import LessonViewer from '../components/LessonViewer';
import axios from 'axios';

const LessonPage = () => {
    const { lessonId, enrollmentId } = useParams();
    const navigate = useNavigate();
    const [lesson, setLesson] = useState(null);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);
    
    useEffect(() => {
        loadLessonData();
    }, [lessonId, enrollmentId]);
    
    const loadLessonData = async () => {
        try {
            setIsLoading(true);
            const response = await axios.get(`/api/lessons/${lessonId}`);
            
            if (response.data.success) {
                setLesson(response.data.data);
            } else {
                setError('Failed to load lesson data');
            }
        } catch (err) {
            console.error('Error loading lesson data:', err);
            setError('Failed to load lesson data');
        } finally {
            setIsLoading(false);
        }
    };
    
    const handleLessonComplete = () => {
        // Navigate to the next lesson or course page
        if (lesson && lesson.next_lesson_id) {
            navigate(`/lessons/${lesson.next_lesson_id}/${enrollmentId}`);
        } else {
            navigate(`/courses/${lesson.course_id}`);
        }
    };
    
    if (isLoading) {
        return <div className="lesson-page-loading">Loading lesson...</div>;
    }
    
    if (error) {
        return <div className="lesson-page-error">{error}</div>;
    }
    
    if (!lesson) {
        return <div className="lesson-page-error">Lesson not found</div>;
    }
    
    return (
        <div className="lesson-page">
            <LessonViewer 
                lessonId={lessonId}
                enrollmentId={enrollmentId}
                videoId={lesson.video_id}
                videoUrl={lesson.video_url}
            />
            
            <div className="lesson-navigation">
                {lesson.previous_lesson_id && (
                    <button 
                        className="btn btn-outline-primary"
                        onClick={() => navigate(`/lessons/${lesson.previous_lesson_id}/${enrollmentId}`)}
                    >
                        Previous Lesson
                    </button>
                )}
                
                {lesson.next_lesson_id ? (
                    <button 
                        className="btn btn-primary"
                        onClick={() => navigate(`/lessons/${lesson.next_lesson_id}/${enrollmentId}`)}
                    >
                        Next Lesson
                    </button>
                ) : (
                    <button 
                        className="btn btn-success"
                        onClick={handleLessonComplete}
                    >
                        Complete Course
                    </button>
                )}
            </div>
        </div>
    );
};

export default LessonPage; 