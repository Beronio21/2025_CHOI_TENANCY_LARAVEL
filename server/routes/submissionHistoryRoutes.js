const express = require('express');
const router = express.Router();
let submissionhistory = require('../../db/submissionhistorydb');

// GET: Retrieve all submission history records or by student ID
router.get('/', (req, res) => {
    res.json(submissionhistory);
});

router.get('/:student_id', (req, res) => {
    const studentHistory = submissionhistory.filter(s => s.student_id === req.params.student_id);
    res.json(studentHistory);
});

// POST: Add a new submission history record
router.post('/', (req, res) => {
    const newSubmission = req.body;
    if (!newSubmission.submission_history_id || !newSubmission.student_id || !newSubmission.thesis_id) {
        return res.status(400).send({ message: "Required fields are missing" });
    }

    submissionhistory.push(newSubmission);
    res.status(201).json(newSubmission);
});

// PATCH: Update submission status or feedback for a specific record
router.patch('/:id', (req, res) => {
    const submission = submissionhistory.find(s => s.submission_history_id == req.params.id);
    if (!submission) {
        return res.status(404).send({ message: "Submission history not found" });
    }

    if (req.body.submission_status) submission.submission_status = req.body.submission_status;
    if (req.body.feedback) submission.feedback = req.body.feedback;
    
    res.json(submission);
});

// DELETE: Remove a submission history record by ID
router.delete('/:id', (req, res) => {
    const index = submissionhistory.findIndex(s => s.submission_history_id == req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Submission history not found" });
    }

    const deletedRecord = submissionhistory.splice(index, 1);
    res.json(deletedRecord[0]);
});

module.exports = router;
