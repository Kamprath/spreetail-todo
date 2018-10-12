export default class {
    constructor(id, title, description, priority, status, due_at, created_at, updated_at) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.priority = typeof priority === 'undefined' ? 1 : priority;
        this.status = status;
        this.due_at = due_at;
        this.created_at = created_at;
        this.updated_at = updated_at;
    }
}