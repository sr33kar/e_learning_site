package com.example.eLearning_site.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.eLearning_site.entities.Feedback;

public interface FeedbackRepository extends JpaRepository<Feedback, Integer> {

}
