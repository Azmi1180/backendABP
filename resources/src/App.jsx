import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import './App.css'
import LandingPage from './pages/landingPage'
import Login from './pages/login'
import NewsHome from './pages/newsHome'
import SignUp from './pages/signup'
import SavedArticles from './pages/savedArticles'

function App() {
  return (
    <div>
      <Router>
        <Routes>
          <Route path='/' element={<LandingPage />} />
          <Route path='/login' element={<Login />} />
          <Route path='/home' element={<NewsHome />} />
          <Route path='/signup' element={<SignUp />} />
          <Route path='/savedArticles' element={<SavedArticles />} />
        </Routes>
      </Router>

    </div>
  )
}

export default App;
