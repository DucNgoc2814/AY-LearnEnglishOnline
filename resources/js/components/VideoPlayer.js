import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';

const VideoPlayer = ({ videoId, videoUrl, onProgressUpdate }) => {
    const videoRef = useRef(null);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);
    const [progress, setProgress] = useState({
        watched_seconds: 0,
        percentage: 0,
        last_position: 0,
        completed: false
    });
    
    // Save progress interval (in milliseconds)
    const SAVE_INTERVAL = 5000;
    let saveInterval = null;
    
    useEffect(() => {
        // Load saved progress when component mounts
        loadProgress();
        
        // Set up event listeners
        if (videoRef.current) {
            videoRef.current.addEventListener('timeupdate', handleTimeUpdate);
            videoRef.current.addEventListener('loadedmetadata', handleLoadedMetadata);
            videoRef.current.addEventListener('ended', handleVideoEnded);
            videoRef.current.addEventListener('pause', handleVideoPause);
        }
        
        // Clean up event listeners on unmount
        return () => {
            if (videoRef.current) {
                videoRef.current.removeEventListener('timeupdate', handleTimeUpdate);
                videoRef.current.removeEventListener('loadedmetadata', handleLoadedMetadata);
                videoRef.current.removeEventListener('ended', handleVideoEnded);
                videoRef.current.removeEventListener('pause', handleVideoPause);
            }
            
            // Clear any pending save interval
            if (saveInterval) {
                clearInterval(saveInterval);
            }
        };
    }, [videoId]);
    
    // Load saved progress from the server
    const loadProgress = async () => {
        try {
            setIsLoading(true);
            const response = await axios.get(`/api/video-progress/${videoId}`);
            
            if (response.data.success && response.data.data) {
                const savedProgress = response.data.data;
                setProgress(savedProgress);
                
                // Set video to the last position if it exists
                if (videoRef.current && savedProgress.last_position > 0) {
                    videoRef.current.currentTime = savedProgress.last_position;
                }
                
                // Notify parent component
                if (onProgressUpdate) {
                    onProgressUpdate(savedProgress);
                }
            }
        } catch (err) {
            console.error('Error loading video progress:', err);
            setError('Failed to load video progress');
        } finally {
            setIsLoading(false);
        }
    };
    
    // Handle video time update
    const handleTimeUpdate = () => {
        if (!videoRef.current) return;
        
        const currentTime = videoRef.current.currentTime;
        const duration = videoRef.current.duration;
        
        // Calculate percentage
        const percentage = duration > 0 ? Math.min(100, Math.round((currentTime / duration) * 100)) : 0;
        
        // Update local state
        setProgress(prev => ({
            ...prev,
            watched_seconds: Math.floor(currentTime),
            percentage,
            last_position: currentTime,
            completed: percentage >= 90
        }));
    };
    
    // Handle video metadata loaded
    const handleLoadedMetadata = () => {
        setIsLoading(false);
    };
    
    // Handle video ended
    const handleVideoEnded = () => {
        saveProgress(true);
    };
    
    // Handle video pause
    const handleVideoPause = () => {
        saveProgress();
    };
    
    // Save progress to the server
    const saveProgress = async (forceComplete = false) => {
        if (!videoRef.current) return;
        
        try {
            const currentTime = videoRef.current.currentTime;
            const duration = videoRef.current.duration;
            const percentage = duration > 0 ? Math.min(100, Math.round((currentTime / duration) * 100)) : 0;
            
            const progressData = {
                video_id: videoId,
                watched_seconds: Math.floor(currentTime),
                percentage,
                last_position: currentTime,
                completed: forceComplete || percentage >= 90
            };
            
            await axios.post('/api/video-progress', progressData);
            
            // Notify parent component
            if (onProgressUpdate) {
                onProgressUpdate(progressData);
            }
        } catch (err) {
            console.error('Error saving video progress:', err);
        }
    };
    
    // Set up interval to save progress periodically
    useEffect(() => {
        // Clear any existing interval
        if (saveInterval) {
            clearInterval(saveInterval);
        }
        
        // Set up new interval
        saveInterval = setInterval(() => {
            if (videoRef.current && !videoRef.current.paused) {
                saveProgress();
            }
        }, SAVE_INTERVAL);
        
        // Clean up interval on unmount
        return () => {
            if (saveInterval) {
                clearInterval(saveInterval);
            }
        };
    }, [videoId]);
    
    if (isLoading) {
        return <div className="video-loading">Loading video...</div>;
    }
    
    if (error) {
        return <div className="video-error">{error}</div>;
    }
    
    return (
        <div className="video-player-container">
            <video
                ref={videoRef}
                className="video-player"
                src={videoUrl}
                controls
                playsInline
            />
            
            <div className="video-progress-info">
                <div className="progress-bar">
                    <div 
                        className="progress-fill" 
                        style={{ width: `${progress.percentage}%` }}
                    />
                </div>
                <div className="progress-text">
                    {progress.percentage}% completed
                </div>
            </div>
        </div>
    );
};

export default VideoPlayer; 