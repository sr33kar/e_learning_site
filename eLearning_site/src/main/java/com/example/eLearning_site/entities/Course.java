package com.example.eLearning_site.entities;

import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name="course")
public class Course {
	@Id
	public String courseId;
	public String courseName;
	public Course() {
		super();
		// TODO Auto-generated constructor stub
	}
	public String courseResource;
	public String courseDescription;
	public long courseFee;
	public Course(String courseId, String courseName, String courseResource, String courseDescription, long courseFee) {
		super();
		this.courseId = courseId;
		this.courseName = courseName;
		this.courseResource = courseResource;
		this.courseDescription = courseDescription;
		this.courseFee = courseFee;
	}
	public String getCourseId() {
		return courseId;
	}
	public void setCourseId(String courseId) {
		this.courseId = courseId;
	}
	public String getCourseName() {
		return courseName;
	}
	public void setCourseName(String courseName) {
		this.courseName = courseName;
	}
	public String getCourseResource() {
		return courseResource;
	}
	public void setCourseResource(String courseResource) {
		this.courseResource = courseResource;
	}
	public String getCourseDescription() {
		return courseDescription;
	}
	public void setCourseDescription(String courseDescription) {
		this.courseDescription = courseDescription;
	}
	public long getCourseFee() {
		return courseFee;
	}
	public void setCourseFee(long courseFee) {
		this.courseFee = courseFee;
	}
	
	
}
