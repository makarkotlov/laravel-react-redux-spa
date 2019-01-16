const initState = {
    projects: [
        { id: 1, title: "Fucka", content: "Yeah" },
        { id: 2, title: "Mucho", content: "Gusto" },
        { id: 3, title: "Hola", content: "Content" }
    ]
};
const projectReducer = (state = initState, action) => {
    switch (action.type) {
        case "CREATE_PROJECT":
            console.log("created project", action.project);
            return Object.assign({}, state, {
                todos: [
                    ...state.todos,
                    {
                        text: action.text,
                        completed: false
                    }
                ]
            });
        default:
            return state;
    }
};
export default projectReducer;
