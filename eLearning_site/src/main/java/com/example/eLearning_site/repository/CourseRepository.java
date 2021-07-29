package com.example.eLearning_site.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.eLearning_site.entities.Course;

public interface CourseRepository extends JpaRepository<Course, String> {

}
