// server/routes/thesisRoutes.js
const express = require('express');
const router = express.Router();
let thesissubmissiondb = require('../../db/thesissubmissiondb'); // Adjusted to go up a level


// GET: Retrieve all thesis submissions or find by ID
router.get('/', (req, res) => {
    res.json(thesissubmissiondb);
});

router.get('/:id', (req, res) => {
    const thesis = thesissubmissiondb.find(t => t.thesis_id == req.params.id);
    if (thesis) {
        res.json(thesis);
    } else {
        res.status(404).send({ message: "Thesis not found" });
    }
});

// POST: Add a new thesis submission
router.post('/', (req, res) => {
    const newThesis = req.body;
    if (!newThesis.thesis_id) {
        return res.status(400).send({ message: "Thesis ID is required" });
    }
    
    const existingThesis = thesissubmissiondb.find(t => t.thesis_id == newThesis.thesis_id);
    if (existingThesis) {
        return res.status(400).send({ message: "Thesis ID already exists" });
    }
    
    thesissubmissiondb.push(newThesis);
    res.status(201).json(newThesis);
});

// PUT: Replace thesis submission data
router.put('/:id', (req, res) => {
    const index = thesissubmissiondb.findIndex(t => t.thesis_id == req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Thesis not found" });
    }

    // Replace the thesis data
    thesissubmissiondb[index] = { ...req.body, thesis_id: req.params.id };
    res.json(thesissubmissiondb[index]);
});

// PATCH: Update specific fields of thesis submission data
router.patch('/:id', (req, res) => {
    const thesis = thesissubmissiondb.find(t => t.thesis_id == req.params.id);
    if (!thesis) {
        return res.status(404).send({ message: "Thesis not found" });
    }

    // Update fields provided in the request body
    Object.assign(thesis, req.body);
    res.json(thesis);
});

// DELETE: Remove a thesis submission
router.delete('/:id', (req, res) => {
    const index = thesissubmissiondb.findIndex(t => t.thesis_id == req.params.id);
    if (index === -1) {
        return res.status(404).send({ message: "Thesis not found" });
    }

    // Remove the thesis from the array
    const deletedThesis = thesissubmissiondb.splice(index, 1);
    res.json(deletedThesis[0]);
});

module.exports = router;
