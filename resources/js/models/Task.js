export default class {
    /**
     * @param {int} id
     * @param {string} title
     * @param {string} description
     * @param {int} priority
     * @param {int} status
     * @param {string} due_at
     * @param {string} created_at
     * @param {string} updated_at
     * @param {array} subtasks
     * @param {string} color_class
     */
    constructor(id, title, description, priority, status, due_at, created_at, updated_at, subtasks, color_class) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.priority = typeof priority === 'undefined' ? 1 : priority;
        this.status = typeof status === 'undefined' ? 0 : status;
        this.due_at = due_at;
        this.created_at = created_at;
        this.updated_at = updated_at;
        this.subtasks = subtasks || [];
        this.color_class = color_class || 'is-primary';
    }
}