import React, { useState, useEffect } from 'react';
import VideoPlayer from './VideoPlayer';
import LessonProgress from './LessonProgress';
import axios from 'axios';

const LessonViewer = ({ lessonId, enrollmentId, videoId, videoUrl }) => {
    const [lessonData, setLessonData] = useState(null);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);
    
    useEffect(() => {
        loadLessonData();
    }, [lessonId, enrollmentId]);
    
    // Load lesson data
    const loadLessonData = async () => {
        try {
            setIsLoading(true);
            const response = await axios.get(`/api/lessons/${lessonId}`);
            
            if (response.data.success) {
                setLessonData(response.data.data);
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
    
    // Handle video progress update
    const handleVideoProgressUpdate = (videoProgress) => {
        // Update lesson progress based on video progress
        if (lessonData && videoProgress) {
            const totalVideos = lessonData.videos?.length || 1;
            const watchedSeconds = videoProgress.watched_seconds;
            const totalSeconds = lessonData.duration || 0;
            
            // Calculate lesson progress percentage based on video progress
            const lessonPercentage = Math.min(100, Math.round((watchedSeconds / totalSeconds) * 100));
            
            // Update lesson progress
            updateLessonProgress(watchedSeconds, totalSeconds, lessonPercentage >= 90 ? 'completed' : 'in_progress');
        }
    };
    
    // Update lesson progress
    const updateLessonProgress = async (watchedTime, totalTime, status) => {
        try {
            await axios.post('/api/lesson-progress', {
                lesson_id: lessonId,
                enrollment_id: enrollmentId,
                watched_time: watchedTime,
                total_time: totalTime,
                status
            });
        } catch (err) {
            console.error('Error updating lesson progress:', err);
        }
    };
    
    // Handle lesson progress update
    const handleLessonProgressUpdate = (lessonProgress) => {
        // You can use this to update UI or trigger other actions when lesson progress changes
        console.log('Lesson progress updated:', lessonProgress);
    };
    
    if (isLoading) {
        return <div className="lesson-viewer-loading">Loading lesson...</div>;
    }
    
    if (error) {
        return <div className="lesson-viewer-error">{error}</div>;
    }
    
    if (!lessonData) {
        return <div className="lesson-viewer-error">Lesson not found</div>;
    }
    
    return (
        <div className="lesson-viewer-container">
            <div className="lesson-header">
                <h1>{lessonData.title}</h1>
                <p className="lesson-description">{lessonData.description}</p>
            </div>
            
            <div className="lesson-content">
                <div className="video-section">
                    <VideoPlayer 
                        videoId={videoId} 
                        videoUrl={videoUrl} 
                        onProgressUpdate={handleVideoProgressUpdate} 
                    />
                </div>
                
                <div className="progress-section">
                    <LessonProgress 
                        lessonId={lessonId} 
                        enrollmentId={enrollmentId} 
                        onProgressUpdate={handleLessonProgressUpdate} 
                    />
                </div>
            </div>
            
            {lessonData.materials && lessonData.materials.length > 0 && (
                <div className="lesson-materials">
                    <h3>Lesson Materials</h3>
                    <ul>
                        {lessonData.materials.map((material, index) => (
                            <li key={index}>
                                <a href={material.url} target="_blank" rel="noopener noreferrer">
                                    {material.title}
                                </a>
                            </li>
                        ))}
                    </ul>
                </div>
            )}
        </div>
    );
};

export default LessonViewer; 