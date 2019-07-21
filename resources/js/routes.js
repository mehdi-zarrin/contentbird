import NotFoundComponent from "./components/NotFoundComponent";
import AnalyzerFormComponent from "./components/AnalyzerFormComponent";
import AnalyzerResultComponent from "./components/AnalyzerResultComponent";

export default {
    mode: 'history',
    linkExactActiveClass: 'is-active',
    routes: [
        {
            path: '*',
            component: NotFoundComponent
        },
        {
            path: '/',
            component: AnalyzerFormComponent
        },

        {
            path: '/show/:id',
            component: AnalyzerResultComponent,
        },
    ]
}