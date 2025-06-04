import React from 'react';
import { FaTwitter, FaInstagram } from 'react-icons/fa';
import instannewsLogo from '../assets/instannews.png'
import dailydigestLogo from '../assets/dailydigest.png'
import newsLogo from '../assets/news.png'
import filtersLogo from '../assets/filters.png'
import smartNewsLogo from '../assets/search.png'
import bookmarkLogo from '../assets/bookmark .png'
import personPhone from '../assets/foto.png'

const LandingPage = () => {
  return (
    <div className="w-full max-w-full m-0 p-0 bg-white shadow-[0_0_30px_rgba(0,0,0,0.08)]">
      <header className="pb-8">
        <div className="flex justify-between p-5 pr-12 bg-white border-b border-gray-300 shadow-md">
          <div></div>
          <a href="/login" className="bg-[#003479] text-white py-3 px-8 rounded-xl text-sm font-medium hover:bg-blue-900">
            Log In Now →
          </a>
        </div>

        <div className="flex flex-col md:flex-row items-center justify-center p-8 gap-8 text-center">
          <div className="max-w-[200px]">
            <img src={instannewsLogo} alt="Instannews Logo" className="w-full h-auto" />
          </div>
          <div className="max-w-[500px]">
            <h1 className="font-bold text-[#003479] text-[2.5rem] mb-2">Instannews</h1>
            <h2 className="text-gray-700 text-2xl font-medium mb-4">Daily Digest News at Your Fingertips</h2>
            <p className="text-gray-600 text-base mb-6">
              In this digital age, information spreads rapidly. Instannews is the solution to access news efficiently through daily digests and effective news management.
            </p>
          </div>
        </div>
      </header>

      <section className="py-8 px-16 bg-white max-w-[800px] mx-auto">
        <h2 className="font-bold text-[#003479] text-[1.8rem] text-center mb-8">Key Features</h2>

        {[
          { icon: dailydigestLogo, title: 'Daily Digest', text: 'Receive a daily summary of important news automatically curated by AI' },
          { icon: newsLogo, title: 'Automated News Collection', text: 'Automatically gathered every day via Newsdata.io API' },
          { icon: filtersLogo, title: 'News Category Filters', text: 'Instannews filters the news to deliver only relevant information to you.' },
          { icon: smartNewsLogo, title: 'Smart News Search', text: 'The search feature makes it easy to find news based on keywords' },
          { icon: bookmarkLogo, title: 'CRUD Bookmarking', text: 'Manage and access your favorite news anytime' },
        ].map((feature, index) => (
          <div key={index} className="flex items-start mb-8 gap-6">
            <div className="w-10 h-10 flex items-center justify-center flex-shrink-0">
              <img src={feature.icon} alt={`${feature.title} Icon`} className="w-full h-auto" />
            </div>
            <div className="max-w-[600px]">
              <h3 className="text-gray-800 mb-2 text-[1.3rem] font-semibold">{feature.title}</h3>
              <p className="text-gray-600 text-base">{feature.text}</p>
            </div>
          </div>
        ))}
      </section>

      <section className="py-9 px-16 bg-white max-w-[800px] mx-auto">
        <h2 className="text-[#003479] text-[1.8rem] mb-8 font-bold">Why Instannews?</h2>
        <div className="flex flex-col md:flex-row gap-8 items-center">
          <div className="flex-1 max-w-[200px]">
            <img src={personPhone} alt="Person using phone" className="w-full h-auto" />
          </div>
          <div className="flex-2">
            <ul className="list-none">
              {[
                'Flexible Access: Enjoy news via both web and mobile apps, anytime, anywhere.',
                'AI-Powered: Leverage Gemini API technology to deliver summarized news efficiently.',
                'Easy News Management: Save and organize news you consider important with ease.',
                'User-Centric: Customize your experience with category filters and smart search.',
              ].map((point, idx) => (
                <li key={idx} className="mb-4 relative pl-6">
                  <span className="absolute left-0  font-bold">•</span>
                  <strong>{point.split(':')[0]}:</strong>{' '}{point.split(':')[1]}
                </li>
              ))}
            </ul>
          </div>
        </div>
      </section>

      <section className="py-12 px-8 text-center bg-white">
        <p className="text-[#4C70A1] text-2xl font-semibold max-w-[700px] mx-auto mb-20 leading-relaxed">
          Instannews is available on both web and mobile platforms.<br />
          Sign up today to start accessing news in a more efficient and enjoyable way!
        </p>
        <div className="flex justify-center gap-4">
          <a href="/login" className="py-3 px-12 rounded-2xl bg-[#003479] text-white font-medium hover:bg-blue-900">
            Sign In
          </a>
          <a href="/signup" className="py-3 px-12 rounded-2xl bg-[#5f82c1] text-white font-medium hover:bg-[#4b6da1]">
            Sign Up
          </a>
        </div>
      </section>

      <footer className="bg-[#003479] text-white py-12 px-8">
        <div className="flex flex-col md:flex-row justify-between max-w-[1000px] mx-auto">
          <div className="max-w-[120px] mb-8 md:mb-0">
            <img src={instannewsLogo} alt="Instannews Logo" className="w-full h-auto mb-4" />
            <div className="flex gap-4 text-xl">
              <a href="#"><FaTwitter /></a>
              <a href="#"><FaInstagram /></a>
            </div>
          </div>
          <div className="flex gap-16">
            <div>
              <h3 className="text-base font-semibold mb-4">Navigation</h3>
              <ul>
                <li className="mb-2"><a href="index.html" className="text-[#ccd6e6] hover:text-white">Home / Landing</a></li>
                <li className="mb-2"><a href="#" className="text-[#ccd6e6] hover:text-white">About Instannews</a></li>
                <li className="mb-2"><a href="#" className="text-[#ccd6e6] hover:text-white">Terms & Conditions</a></li>
                <li className="mb-2"><a href="#" className="text-[#ccd6e6] hover:text-white">Privacy Policy</a></li>
              </ul>
            </div>
            <div>
              <h3 className="text-base font-semibold mb-4">Instannews</h3>
              <ul>
                <li className="mb-2"><a href="login.html" className="text-[#ccd6e6] hover:text-white">Log In</a></li>
                <li className="mb-2"><a href="signup.html" className="text-[#ccd6e6] hover:text-white">Sign Up</a></li>
                <li className="mb-2"><a href="#" className="text-[#ccd6e6] hover:text-white">Key Features</a></li>
                <li className="mb-2"><a href="#" className="text-[#ccd6e6] hover:text-white">Why Instannews</a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default LandingPage;
