package com.example.eLearning_site.entities;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.Table;

@Entity
@Table(name="feedback")
public class Feedback {

	@Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
	@Column(name = "feedback_id", nullable = false)
	public int feedbackId;
	@Column(name = "name")
	public String name;
	@Column(name = "email")
	public String email;
	@Column(name = "feedback_text")
	public String feedbackText;
	@Column(name = "user_id")
	public String userId;
	public Feedback() {
		super();
		// TODO Auto-generated constructor stub
	}
	public int getFeedbackId() {
		return feedbackId;
	}
	public void setFeedbackId(int feedbackId) {
		this.feedbackId = feedbackId;
	}
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public String getFeedbackText() {
		return feedbackText;
	}
	public void setFeedbackText(String feedbackText) {
		this.feedbackText = feedbackText;
	}
	public String getUserId() {
		return userId;
	}
	public void setUserId(String userId) {
		this.userId = userId;
	}
	
	
}
