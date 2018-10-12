export default class {
    /**
     * @param {int} id
     * @param {int} task_id
     * @param {string} text
     * @param {boolean} is_complete
     */
    constructor(id, task_id, text, is_complete) {
        this.id = id;
        this.task_id = task_id;
        this.text = text;
        this.is_complete = is_complete;
    }
}