import React, { useState, useEffect } from 'react';
import axios from 'axios';

const LessonProgress = ({ lessonId, enrollmentId, onProgressUpdate }) => {
    const [progress, setProgress] = useState({
        watched_time: 0,
        total_time: 0,
        status: 'in_progress',
        last_watched_at: null,
        completed_at: null
    });
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);
    
    useEffect(() => {
        loadProgress();
    }, [lessonId, enrollmentId]);
    
    // Load saved progress from the server
    const loadProgress = async () => {
        try {
            setIsLoading(true);
            const response = await axios.get(`/api/lesson-progress/${lessonId}/${enrollmentId}`);
            
            if (response.data.success && response.data.data) {
                const savedProgress = response.data.data;
                setProgress(savedProgress);
                
                // Notify parent component
                if (onProgressUpdate) {
                    onProgressUpdate(savedProgress);
                }
            }
        } catch (err) {
            console.error('Error loading lesson progress:', err);
            setError('Failed to load lesson progress');
        } finally {
            setIsLoading(false);
        }
    };
    
    // Update lesson progress
    const updateProgress = async (watchedTime, totalTime, status = 'in_progress') => {
        try {
            const progressData = {
                lesson_id: lessonId,
                enrollment_id: enrollmentId,
                watched_time: watchedTime,
                total_time: totalTime,
                status
            };
            
            const response = await axios.post('/api/lesson-progress', progressData);
            
            if (response.data.success) {
                setProgress(response.data.data);
                
                // Notify parent component
                if (onProgressUpdate) {
                    onProgressUpdate(response.data.data);
                }
                
                return true;
            }
            
            return false;
        } catch (err) {
            console.error('Error updating lesson progress:', err);
            return false;
        }
    };
    
    // Mark lesson as completed
    const markAsCompleted = async () => {
        return updateProgress(progress.watched_time, progress.total_time, 'completed');
    };
    
    // Calculate progress percentage
    const getProgressPercentage = () => {
        if (progress.total_time <= 0) {
            return 0;
        }
        
        return Math.min(100, Math.round((progress.watched_time / progress.total_time) * 100));
    };
    
    // Format time in seconds to HH:MM:SS
    const formatTime = (seconds) => {
        const hours = Math.floor(seconds / 3600);
        const minutes = Math.floor((seconds % 3600) / 60);
        const secs = seconds % 60;
        
        return [hours, minutes, secs]
            .map(v => v < 10 ? `0${v}` : v)
            .join(':');
    };
    
    if (isLoading) {
        return <div className="lesson-progress-loading">Loading progress...</div>;
    }
    
    if (error) {
        return <div className="lesson-progress-error">{error}</div>;
    }
    
    const percentage = getProgressPercentage();
    
    return (
        <div className="lesson-progress-container">
            <div className="progress-header">
                <h3>Lesson Progress</h3>
                <span className={`status-badge ${progress.status}`}>
                    {progress.status === 'completed' ? 'Completed' : 'In Progress'}
                </span>
            </div>
            
            <div className="progress-bar">
                <div 
                    className="progress-fill" 
                    style={{ width: `${percentage}%` }}
                />
            </div>
            
            <div className="progress-details">
                <div className="time-info">
                    <span>Watched: {formatTime(progress.watched_time)}</span>
                    <span>Total: {formatTime(progress.total_time)}</span>
                </div>
                
                <div className="percentage">
                    {percentage}% completed
                </div>
            </div>
            
            {progress.last_watched_at && (
                <div className="last-watched">
                    Last watched: {new Date(progress.last_watched_at).toLocaleString()}
                </div>
            )}
            
            {progress.completed_at && (
                <div className="completed-at">
                    Completed on: {new Date(progress.completed_at).toLocaleString()}
                </div>
            )}
        </div>
    );
};

export default LessonProgress; 